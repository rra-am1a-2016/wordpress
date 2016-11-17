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
define('DB_NAME', 'am1a_2016_wordpress_groenten');

/** MySQL database username */
define('DB_USER', 'rra_wp');

/** MySQL database password */
define('DB_PASSWORD', 'geheim');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'JdM2+a9)wgxx4/wIlPg*eW[${r!~q4ND|QEBPw;|V^zAj=%7z`Z6j.NtO;NEg{8u');
define('SECURE_AUTH_KEY',  'Xm_Uiafc.g{OOe3f5qUS+K=SGQkG7cg{^TNcJ!<Nwlz&%+6Yg:4D]rB^H$?-DEgC');
define('LOGGED_IN_KEY',    'O$`{omcd FbA#.-mgqj#|T22+;$grp@2hL=`Z14=o]E{?T4X2,IW0A,66boQijNW');
define('NONCE_KEY',        '#7`_+E~+*UokFi3$0c;=^n2^N9LWJB&R+Q6gyRQ7E^h.Bn|:7Z/`4z(Cyk:8pWD5');
define('AUTH_SALT',        'E*-`2+ XXW}:+LypeRkmQ(qn%F*?2w8|to&a,ztX-EluUC3r^l]^P[A;,Y4)@I%^');
define('SECURE_AUTH_SALT', '9WqmECEml!=%~kwW}t>q{*J^NYQOt!l8;VYaMjZ]6pWNUP|V!*X`-R06^[.3[YjH');
define('LOGGED_IN_SALT',   '0/Ht=p}XyE=~Vl dq82+|XISmg~8s*GSX}+S{(ac4UJfzBlUCx=t~OQ3}!vU+M4R');
define('NONCE_SALT',       'i6ozU/.p[`H|d{@:T2bQGeV*>/+4bEL]|RJ1p1cJUCQ>-cE/XEKFS4+?DYOP( 9l');
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
