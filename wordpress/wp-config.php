<?php
/**
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package Wordpress Kickstart
 */

// ** MySQL settings - You can get this info from your web host ** //
define('DB_NAME',       '');
define('DB_USER',       '');
define('DB_PASSWORD',   '');
define('DB_HOST',       'mysql');
define('DB_CHARSET',    'utf8');
define('DB_COLLATE',    '');

/**
 * Unique auth keys and salts.
 * @link https://api.wordpress.org/secret-key/1.1/salt/
 */
define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');

/**
 * WP Table prefix
 */
$table_prefix  = 'wp_';

/**
 * FTP Permissions.
 */

// DEVELOPMENT
define( 'FS_METHOD','direct' );

// PRODUCTION
// define( 'FS_METHOD', 'ftpext' );
// define( 'FTP_BASE', '/path/to/wordpress/' );
// define( 'FTP_CONTENT_DIR', '/path/to/wordpress/wp-content/' );
// define( 'FTP_PLUGIN_DIR ', '/path/to/wordpress/wp-content/plugins/' );
// define( 'FTP_PUBKEY', '/home/username/.ssh/id_rsa.pub' );
// define( 'FTP_PRIKEY', '/home/username/.ssh/id_rsa' );
// define( 'FTP_USER', 'username' );
// define( 'FTP_PASS', 'password' );
// define( 'FTP_HOST', 'ftp.example.org' );
// define( 'FTP_SSL', false );

/**
 * Override of default file permissions.
 *
 * The FS_CHMOD_DIR and FS_CHMOD_FILE define statements allow override of default file permissions.
 * If a host uses restrictive file permissions (e.g. 400) for all user files, and refuses to access
 * files which have group or world permissions set, these definitions could solve the problem.
 * Note that the '0755' is an octal value. Octal values must be prefixed with a 0 and are not
 * delineated with single quotes (').
 *
 * More information: https://codex.wordpress.org/Changing_File_Permissions
 */
define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );

/**
 * SSL Permissions.
 */
define( 'FORCE_SSL_LOGIN', false );
define( 'FORCE_SSL_ADMIN', false );

/**
 * WordPress Language.
 */
define( 'WPLANG', 'pt_BR' );

/**
 * WordPress Optimization and Security.
 */
define( 'WP_POST_REVISIONS', false );
define( 'EMPTY_TRASH_DAYS', 30 );
define( 'WP_ALLOW_REPAIR', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', false );
define( 'AUTOMATIC_UPDATER_DISABLED' , true );
define( 'IMAGE_EDIT_OVERWRITE', true );
define( 'WP_HTTP_BLOCK_EXTERNAL', false );

/**
 * Memory limit
 */
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );

/**
 * WP Debugging mode
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', true );

/**
 * Cronjobs
 */
define( 'DISABLE_WP_CRON', 'true' );
// define( 'ALTERNATE_WP_CRON', 'false' );

/**
 * Dynamically set WP_HOME and WP_SITEURL
 */
define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
// if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
// 	$_SERVER['HTTPS'] = 'on';
// }

/**
 * AWS S3 Connection
 */
// $awsdata = [
//   'provider'            => 'aws',
//   'access-key-id'       => '',
//   'secret-access-key'   => ''
// ];
// define( 'AS3CF_SETTINGS', serialize( $awsdata ) );

/* That's all, stop editing! */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
