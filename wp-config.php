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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fmps4688_live' );

/** MySQL database username */
define( 'DB_USER', 'fmps4688_wp646' );

/** MySQL database password */
define( 'DB_PASSWORD', '8pS]4P9s@b' );

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
define( 'AUTH_KEY',         'naxqamjsuamgqg77oh6rokm742w27wqbgwzk1dsasjtfuvyrv8e23uljusjrpu64' );
define( 'SECURE_AUTH_KEY',  'frfsg7eethohysgx0nminssexj0iqr4heovkv0cwd9swuw0teoxwgjua7hym9iat' );
define( 'LOGGED_IN_KEY',    'nltgxftikjy9c83uerhloslcmxec8s4lgz8km5apksmn6231cowdzyddlwrpvs3d' );
define( 'NONCE_KEY',        'vh8b5irjcfozkklbivwajgbrzf5d6wcu69t9yaj0k267lejzalm6aocavkccaw2q' );
define( 'AUTH_SALT',        'ftts0zy2dtjb0be6lakekhcr1kkrtrwri18zn2dgkyeigdif5ygv94wb7gk95bbd' );
define( 'SECURE_AUTH_SALT', 'tdxry8alan2mitglsbgfhrmlwucv6adevx9ziqg5gd5wuqulew5aauvrvqflclyv' );
define( 'LOGGED_IN_SALT',   'rgk758vlx0iblj3xewawfptbrjdaewplidigwwy79u1yxffdjuvqo19pfnlaj4ku' );
define( 'NONCE_SALT',       'bmbtl6s1gakkq6sfweej1o8fes1bujwqqv06ubjegep2rfeu312adsearn19wppr' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpzo_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Enables page caching for Cache Enabler. */
if ( ! defined( 'WP_CACHE' ) ) {
	define( 'WP_CACHE', true );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
