<?php
define('CONCATENATE_SCRIPTS', false);
date_default_timezone_set('Europe/Athens');

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_pb_01');
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/** MySQL database username */
define('DB_USER', 'db_user_pb');

/** MySQL database password */
define('DB_PASSWORD', 'D4b2us$e#rR!0');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'A@j7_k7U=7%CL,$7^(xgtS_*1&hx_RS;s^ToLEfTlf G#Ugx$nm=fk4pU.VcBZp;');
define('SECURE_AUTH_KEY',  ' W.TJ?C?~m;r25~C-p%6d)QgL#-|NqjLLnSK_WWF/P.OtIqr4L%`8]eLRkuNpdSS');
define('LOGGED_IN_KEY',    'G/DpEAWSj&B&fCD~-Rg_ye.&Jxd^|54)g5_u5@]!Z0z~LEsvn8 `QdK#5KZsjXS,');
define('NONCE_KEY',        'cMkJXdabA9`Yd|Xe|mpWiWEwg+~hjnRX0-):a%_3(rc15HSp;S`UQ D,cbb~U0%|');
define('AUTH_SALT',        '8_Is,v*! D$up)HbA$y%vtP;(OYL#/sU;^XYuv ~%oah+a+&o]]q*Q 098(!mT)`');
define('SECURE_AUTH_SALT', '6EJ^8nR:1o6*nA22`uGl9cq0*-48a{:dz#Zz|4T67M62)ju~z1<H-Nwr`[?Bc7P,');
define('LOGGED_IN_SALT',   'Rj##Pz:]H8H,43,dLq.xq]7J7p01}I%mXi&p[[kcjumW/2YT:[$1CohOCUA{:~25');
define('NONCE_SALT',       '|<[BCj2J3VrPfGGP+LW>y[&[PA,KqRF,h@9J:>DV6M{CPP!0UQ..~}17BsV2DUAx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pb_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
