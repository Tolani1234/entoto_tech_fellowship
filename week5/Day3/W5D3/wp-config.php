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
define('DB_NAME', 'W5D3');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '}>P$:!z.aaJ=M(;Jh 2[I fCDS.5}cl&pQ:rXnQa*le-ysN*T@~3x7m4W<B^]/RT');
define('SECURE_AUTH_KEY',  'b1g7|3%%)X5B4^|#~iJBk-UC?vJoc8;AZWna!s-kD ZewnAzv|PazFyZaM{#|s:<');
define('LOGGED_IN_KEY',    'UoI5}Z6^YvtC}vhvQ{x%09ewj6D)&WwvKay]j(b=l1A{:k@TM:,_|3pxvF5ao>E/');
define('NONCE_KEY',        '?C$h#Z+C$Dv<x:9u9^Yb+x5GxlnKX%S0uyKVQ{dNT(MD0u/)_L8NIU B=+5[vG$#');
define('AUTH_SALT',        'BEw!)@Ycenc=mk:J9>9.QOt& 4TIaembe%mb~t8$n;OK(S,6.Zp^sA7q .L.3h1a');
define('SECURE_AUTH_SALT', 'Z)_{o[nfD,a7NXhy<9EglH36 Z+T[M 98tv}M!a2,TVM%DR]f/aAvWN[}L :y2u|');
define('LOGGED_IN_SALT',   'SG%VAK{l&bs&zT`*kBlgiyJ%n+BfbNSiZRgZ<X]N?UbyY&JL>N[R.S@YUil56`ms');
define('NONCE_SALT',       '1KF78RNGX|;qWhOA0tt.Df]W6F>u[D{xXP<>j0x&T)soGg1%6Z(vm=sspRd{}fWw');

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
