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
define('DB_NAME', 'wp_myblog');

/** MySQL database username */
define('DB_USER', 'ishu');

/** MySQL database password */
define('DB_PASSWORD', 'your_chosen_password_here');

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
define('AUTH_KEY',         'yDfq.vAA,r/8V?>Xkn,J7h?H0Vi2?w|_EOqhH?o}u*/09x+&<E]IGDYE-s2?L.Gv');
define('SECURE_AUTH_KEY',  'HVk+4Hu~]>~z7s^?O]3l~AHbW Y4O;;p:`=,1kvruUp *E E;k5bL3whaj KfvdX');
define('LOGGED_IN_KEY',    'xh%r6r#c%^sV-dM2JlxAlDEfwMbN+q]VLW4:lyLE,0ib7|yeh%&m+Wb]OfR;8]gE');
define('NONCE_KEY',        ',G4E)naQ2RP{t>coK7W8@bA2..?fLHjL,N*%3AW&_W_Iz(z0Sgc.5qM5SkabjGsZ');
define('AUTH_SALT',        '(JH.h]s3|5(r+<r,ss|cQv<x`1n6Nk!,Tt)O-U^bvS4.GTiZro;90xf ug5/}48i');
define('SECURE_AUTH_SALT', 'vvB5ZQqq,&PPn.EgeH++$!<p>s3bbpdZM<Tv#XmX-Z_``n#fd*-% aI}Vt.pL;/s');
define('LOGGED_IN_SALT',   '|qlidv.3ffN3X#e,R/ee8[TSML%P&lYXFgC){hognyn7zr`?JF<DYt[9&5QS*v8O');
define('NONCE_SALT',       'O{7suxxY-tsraapEyPeO`5!(GVV?WM@%hHOHaasZh6a<N$dx13Cg0aVHjmBnEum*');

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
