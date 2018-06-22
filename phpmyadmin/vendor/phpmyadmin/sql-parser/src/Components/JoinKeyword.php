<?php

/**
 * `JOIN` keyword parser.
 */

namespace PhpMyAdmin\SqlParser\Components;

use PhpMyAdmin\SqlParser\Component;
use PhpMyAdmin\SqlParser\Parser;
use PhpMyAdmin\SqlParser\Token;
use PhpMyAdmin\SqlParser\TokensList;

/**
 * `JOIN` keyword parser.
 *
 * @category   Keywords
 *
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 */
class JoinKeyword extends Component
{
    /**
     * Types of join.
     *
     * @var array
     */
    public static $JOINS = array(
        'CROSS JOIN' => 'CROSS',
        'FULL JOIN' => 'FULL',
        'FULL OUTER JOIN' => 'FULL',
        'INNER JOIN' => 'INNER',
        'JOIN' => 'JOIN',
        'LEFT JOIN' => 'LEFT',
        'LEFT OUTER JOIN' => 'LEFT',
        'RIGHT JOIN' => 'RIGHT',
        'RIGHT OUTER JOIN' => 'RIGHT',
        'NATURAL JOIN' => 'NATURAL',
        'NATURAL LEFT JOIN' => 'NATURAL LEFT',
        'NATURAL RIGHT JOIN' => 'NATURAL RIGHT',
        'NATURAL LEFT OUTER JOIN' => 'NATURAL LEFT OUTER',
        'NATURAL RIGHT OUTER JOIN' => 'NATURAL RIGHT OUTER',
        'STRAIGHT_JOIN' => 'STRAIGHT',
    );

    /**
     * Type of this join.
     *
     * @see static::$JOINS
     *
     * @var string
     */
    public $type;

    /**
     * Join expression.
     *
     * @var Expression
     */
    public $expr;

    /**
     * Join conditions.
     *
     * @var Condition[]
     */
    public $on;

    /**
     * Columns in Using clause.
     *
     * @var ArrayObj
     */
    public $using;

    /**
     * Constructor.
     *
     * @param string $type Join type
     * @param Expression $expr Join expression.
     * @param Condition[] $on Join conditions.
     * @param ArrayObj $using Columns joined.
     *
     * @see JoinKeyword::$JOINS
     */
    public function __construct($type = null, $expr = null, $on = null, $using = null)
    {
        $this->type = $type;
        $this->expr = $expr;
        $this->on = $on;
        $this->using = $using;
    }

    /**
     * @param Parser     $parser  the parser that serves as context
     * @param TokensList $list    the list of tokens that are being parsed
     * @param array      $options parameters for parsing
     *
     * @return JoinKeyword[]
     */
    public static function parse(Parser $parser, TokensList $list, array $options = array())
    {
        $ret = array();

        $expr = new self();

        /**
         * The state of the parser.
         *
         * Below are the states of the parser.
         *
         *      0 -----------------------[ JOIN ]----------------------> 1
         *
         *      1 -----------------------[ expr ]----------------------> 2
         *
         *      2 ------------------------[ ON ]-----------------------> 3
         *      2 -----------------------[ USING ]---------------------> 4
         *
         *      3 --------------------[ conditions ]-------------------> 0
         *
         *      4 ----------------------[ columns ]--------------------> 0
         *
         * @var int
         */
        $state = 0;

        // By design, the parser will parse first token after the keyword.
        // In this case, the keyword must be analyzed too, in order to determine
        // the type of this join.
        if ($list->idx > 0) {
            --$list->idx;
        }

        for (; $list->idx < $list->count; ++$list->idx) {
            /**
             * Token parsed at this moment.
             *
             * @var Token
             */
            $token = $list->tokens[$list->idx];

            // End of statement.
            if ($token->type === Token::TYPE_DELIMITER) {
                break;
            }

            // Skipping whitespaces and comments.
            if (($token->type === Token::TYPE_WHITESPACE) || ($token->type === Token::TYPE_COMMENT)) {
                continue;
            }

            if ($state === 0) {
                if (($token->type === Token::TYPE_KEYWORD)
                    && (!empty(static::$JOINS[$token->keyword]))
                ) {
                    $expr->type = static::$JOINS[$token->keyword];
                    $state = 1;
                } else {
                    break;
                }
            } elseif ($state === 1) {
                $expr->expr = Expression::parse($parser, $list, array('field' => 'table'));
                $state = 2;
            } elseif ($state === 2) {
                if ($token->type === Token::TYPE_KEYWORD) {
                    if ($token->keyword === 'ON') {
                        $state = 3;
                    } elseif ($token->keyword === 'USING') {
                        $state = 4;
                    } else {
                        if (($token->type === Token::TYPE_KEYWORD)
                            && (!empty(static::$JOINS[$token->keyword]))
                        ) {
                            $ret[] = $expr;
                            $expr = new self();
                            $expr->type = static::$JOINS[$token->keyword];
                            $state = 1;
                        } else {
                            /* Next clause is starting */
                            break;
                        }
                    }
                }
            } elseif ($state === 3) {
                $expr->on = Condition::parse($parser, $list);
                $ret[] = $expr;
                $expr = new self();
                $state = 0;
            } elseif ($state === 4) {
                $expr->using = ArrayObj::parse($parser, $list);
                $ret[] = $expr;
                $expr = new self();
                $state = 0;
            }
        }

        if (!empty($expr->type)) {
            $ret[] = $expr;
        }

        --$list->idx;

        return $ret;
    }

    /**
     * @param JoinKeyword[] $component the component to be built
     * @param array         $options   parameters for building
     *
     * @return string
     */
    public static function build($component, array $options = array())
    {
        $ret = array();
        foreach ($component as $c) {
            $ret[] = array_search($c->type, static::$JOINS) . ' ' . $c->expr
                . (!empty($c->on)
                    ? ' ON ' . Condition::build($c->on) : '')
                . (!empty($c->using)
                    ? ' USING ' . ArrayObj::build($c->using) : '');
        }

        return implode(' ', $ret);
    }
}
