<?php
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
define('DB_NAME', 'wordpress_1');

/** MySQL database username */
define('DB_USER', 'wordpress_b');

/** MySQL database password */
define('DB_PASSWORD', 'zeX_9ZfE81');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'j*lIV@UJ8k87SLqnQuV^JUL#(Hx&c@F84%oUIT8EGC9@hpqOFdI1*zf#ytV#lyx&');
define('SECURE_AUTH_KEY',  'FbbYshd3#6ntFENZqMK6kEZb(VbuT*cU@1tZOWEK9jy%HKktzE*Efbu&Z*dtV)0b');
define('LOGGED_IN_KEY',    'P%WbN^&f(^&RoJJwOmp2r*1R%*r1Ef1AYervebBD)Hs)1AT8Wdvq(&p0L4WHiqEn');
define('NONCE_KEY',        'M87t2kfv(@nJn^8N!OvCA*eqB(2O1xNK7vwKTDCi79b4etQrp6kuOr4n7xgwKK4X');
define('AUTH_SALT',        'IQ5Js72b1DYeuRBF^)vQmxr1%txJ!0Km&mAzXmj#rsARe&O^!9xaFPg2IPUZCC&(');
define('SECURE_AUTH_SALT', 'l4e4JzUSGqT*7bI2U94^o)fmd2!0e^7CP(XdEyt1vO6pKInYT*x940F5Ilk&1L^f');
define('LOGGED_IN_SALT',   'i#5)&olCkypl8xBuuMpTbVOs2jbqufnLp9mpj!*@ZGXX0YokTCP)5OhHra2(LFE%');
define('NONCE_SALT',       'DntM^W(@n(GK*MaMUsX3Q&r#ak2uyi!@ma&kM5KRjf^6nq7BhVCI*nN(%8CJC2^q');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
