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
define('DB_NAME', 'php.injera');

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
define('AUTH_KEY',         'VPT-+83;V|tJ>/iFC@qKy$.75-).*^8@mp*9kbtGKF0 YU$?v_M*Tg3B=nFrG.qB');
define('SECURE_AUTH_KEY',  ')5 kVB8HPGS.N)SLF&|ABw-{Oc@{()A?Ad !F:wvh=/{xTUUu@osP$8d,T1Ql0Hn');
define('LOGGED_IN_KEY',    'pMJ,?$3B`yBw,Qlp=;Fr2:]8Ykzx-1PI2B8M@5!#s?r3sz=@Dn~obCMZ/KC_z+7G');
define('NONCE_KEY',        'Rakt~PQ4L/b9uPM0=+~&<fircrW@SKVnJ;YCW:ZiH<3h.@gmr&|)+P}=LOWeZa0v');
define('AUTH_SALT',        ';FlI:~Fr^NbsytzVfXB2X[?av+`~O)OQ+-dvsEPsXX=id4(;(U~BU^i9;:o56Pes');
define('SECURE_AUTH_SALT', ')D3eg6jZpG56-OPYad0K=c@q*hS4IidGMy/m5|6_J.S&4z{#g%txF]BW)jRnIw*4');
define('LOGGED_IN_SALT',   'H^pl/6r2TT]CSjBu hRPbI l>])C{Xjn)!}nT)Bkf>#m}AB7w[u2:pUH+H9zzb%`');
define('NONCE_SALT',       'V2i}E:cOm`hA32P}]sg|XBTt=6+M;8_=}*M{R<OzW7{R(bJfJf43t_rNZChL)s3b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'injera';

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
