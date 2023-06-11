<?php /** @noinspection PhpDefineCanBeReplacedWithConstInspection */

require __DIR__ . '/app.php';

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', env('DB_NAME') );

/** Database username */
define( 'DB_USER', env('DB_USER') );

/** Database password */
define( 'DB_PASSWORD', env('DB_PASS') );

/** Database hostname */
define( 'DB_HOST', env('DB_HOST', 'localhost') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         env('AUTH_KEY') );
define( 'SECURE_AUTH_KEY',  env('SECURE_AUTH_KEY') );
define( 'LOGGED_IN_KEY',    env('LOGGED_IN_KEY') );
define( 'NONCE_KEY',        env('NONCE_KEY') );
define( 'AUTH_SALT',        env('AUTH_SALT') );
define( 'SECURE_AUTH_SALT', env('SECURE_AUTH_SALT') );
define( 'LOGGED_IN_SALT',   env('LOGGED_IN_SALT') );
define( 'NONCE_SALT',       env('NONCE_SALT') );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

if (defined('WP_CLI') && WP_CLI) {
    $_SERVER['HTTP_HOST'] = $_SERVER['SERVER_NAME'] = '1stpengescouts.org.uk';
}

define( 'WP_CONTENT_DIR', __DIR__ . '/content' );
define( 'WP_CONTENT_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/content' );
