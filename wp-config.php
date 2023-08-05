<?php
define('FS_METHOD','direct');
//define('WP_HTTP_BLOCK_EXTERNAL', false);

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lelabo');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charsetto use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '|hiBFoIzf7c]W7zeEji) E(nef,<yY79({t*IE[IX,i{hWLGIYQM9Br#A}{Lvd4/');
define('SECURE_AUTH_KEY', 'gE07d)g3<{+qk5FK_64ahRRhd|a4f36jNAoZ~(W/$GEm-B-v;K:j/@C w/hfil5.');
define('LOGGED_IN_KEY', '8tP2(<m}j|]D-H9hFjvGUUPMvbjMO34SG_^ 9?ak[m=3{>;EvpgkoO9XNsClr1F ');
define('NONCE_KEY', '4q#!aEq.a/R4r(4Dr3M)rw^Sf@l/+:RcEL~?%Tn3B$y[!F|NL]C#KGkffJ5Pkini');
define('AUTH_SALT', 'VUe^,N0o~2q_66V17p?& 6f3) {sGX$mTiJ!NH ~?L}xV5nh#hj48: kG0Sc0p[}');
define('SECURE_AUTH_SALT', ':O1H{IW8I3%TjKknb6o5+6E WCEy+5rvkb}:YEv2R7lewC.l=]J.P.~C! 7N&!!Q');
define('LOGGED_IN_SALT', 'CkTg47mH@q%!fpk,zt+>U7&^V76nqfZ)P<}M[k=ICxGui{3#M?{6NhaskhE+Cf#N');
define('NONCE_SALT', 'lP)$#01Lku:pYA&^P_lI*mw{3Q&~jYiRg;qv4c9k;9f=92d6-RQwJux]CZZUpu,[');
define('WP_CACHE_KEY_SALT', '[bnw/G]ccB!gUUsk=U&W{2R_~.04]?;G]njz)rv`ho5eoO_uKpZev0C) _9PM3wr');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}


/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
