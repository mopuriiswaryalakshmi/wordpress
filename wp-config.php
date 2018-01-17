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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpressuser');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         '.P13X 9}0:D,~n[]lhfa,{-MY,$BDpHx9NX`t 49KTj9^eRmbO-GKJaPq+vF<Eb)');
define('SECURE_AUTH_KEY',  ',iPk.2sHBLf)jcGE11CY:uh)l;VOK%7zKsfT.I?7>4X%,;}LK56P|bz<^*!L!5sy');
define('LOGGED_IN_KEY',    '/tTbiFPXz<Ly9fuAN/*8^`hBav8,APJTG][q@!j7R4 H`iq6Uej,D2-Pa/<6USWA');
define('NONCE_KEY',        '>spgSd~v@FI}$HEc{]<jxWsB]AP.X7^me_DW*%P1&5=yxKFIBZi)~g@v2/UdyppP');
define('AUTH_SALT',        '#dC>CltJSM+UR{^G]]zs~PY?W~e$oLFW+>~lb/>23z#[yyu#$M`.kVx>/n7o0fp5');
define('SECURE_AUTH_SALT', '[iRUg;OjNBKq#^FVnFnr/;9KflRI%HsNJE&7Yr,/Uy,>O6H/m=~NO5L_{5Xw^u-*');
define('LOGGED_IN_SALT',   'rdwl8F~0eb[Mh:vW{<kyi]6MF[M*bgs@*v&YGq[p:uZZjW%cRt7$j$PY&U7N8j8F');
define('NONCE_SALT',       'GpzlX5m/1l.Ej-G/&{d5B#pxh#3UF|ob.BeS[sr_ih}o^~CD-6b>66uwb0G8HEl_');

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
