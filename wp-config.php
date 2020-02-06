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
define( 'DB_NAME', 'octopusplan' );

/** MySQL database username */
define( 'DB_USER', 'indy' );

/** MySQL database password */
define( 'DB_PASSWORD', 'indy' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'aUCj]our#t6F,=7hjbW,`-XXQ7IdNh:}SETY`,|o2;VPng~qv;<:ln)-UDz,poit' );
define( 'SECURE_AUTH_KEY',  'Mva!v(E-Dn/`xOTcy3V{=C#XhSwQEs)8Bq}B=JKep%`J}f!e1wrFc.UlxJ?9p*@s' );
define( 'LOGGED_IN_KEY',    '0ds *OkB3Ngjol!sxfkk.T%v<FKdP0zrCv%5G!,=3[@w *O>V*@m~ sVKcR^S9&=' );
define( 'NONCE_KEY',        '7=+9,OTd(lp@gf6t9(r7B.!k JVnk!9(J7fkwIUq*c>/uL=pPo?%Aa{9NnNoI<3A' );
define( 'AUTH_SALT',        'Y8+D%^/kg%?p3XcvJC;~;(fW+H>+~H:jt)MiV!n6ZkYpQn+)@,U`5.;|1hHMnqBh' );
define( 'SECURE_AUTH_SALT', 'KNo+Ee,t^!</#/KHr[,BX?wY#!W4mdt7E0!)?E;j^3W5!yv@??#v%n2ZYK.;:jrm' );
define( 'LOGGED_IN_SALT',   '*z1Nk-5nKm$3*M%3qAF3e,cDJJ84tVtM84d(~Y3b&[Ev%tcV!2dsEU@K4|<KjN}d' );
define( 'NONCE_SALT',       'k8P%[D+DkUc&V.W|{0jI,4c/]sl9O!yFA`SgwOe:ho)+zsdgeNY7cQzv/-CgiX6{' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
