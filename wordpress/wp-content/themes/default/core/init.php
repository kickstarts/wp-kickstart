<?php


/**
 * Sets content width.
 */
if (!isset($content_width)) {
	$content_width = THEME_CONTENT_WIDTH;
}


/**
 * Setup theme default paths.
 */
define('WP_SITE_URL', site_url());
define('WP_HOME_URL', home_url());
define('WP_SITE_URI', site_url());
define('WP_THEME_PATH', get_template_directory());
define('WP_THEME_URL', get_stylesheet_directory_uri());
define('WP_THEME_URI', get_template_directory_uri());

if (!defined('WP_SCRIPT_URL')) { define('WP_SCRIPT_URL', WP_THEME_URL . '/assets/scripts'); }
if (!defined('WP_STYLE_URL'))  { define('WP_STYLE_URL', WP_THEME_URL . '/assets/styles'); }
if (!defined('WP_IMAGE_URL'))  { define('WP_IMAGE_URL', WP_THEME_URL . '/assets/images'); }
if (!defined('WP_ICON_URL'))   { define('WP_ICON_URL', WP_IMAGE_URL . '/favicons'); }

$core_path    = WP_THEME_PATH . '/core';
$common_path  = $core_path . '/common';
$helpers_path = $core_path . '/helpers';
$mocks_path   = $core_path . '/mocks';
$classes_path = $core_path . '/classes';


/**
 * Require Classes
 */
require_once $classes_path . '/class-options.php';
require_once $classes_path . '/class-metabox.php';
require_once $classes_path . '/class-usermeta.php';


/**
 * Require Common Functions.
 */
require_once $common_path . '/admin.php';
require_once $common_path . '/general.php';
require_once $common_path . '/google.php';
require_once $common_path . '/login.php';
require_once $common_path . '/metabox.php';
require_once $common_path . '/optimize.php';
require_once $common_path . '/options.php';
require_once $common_path . '/posttype.php';
require_once $common_path . '/support.php';
require_once $common_path . '/taxonomy.php';


/**
 * Require Helper Functions.
 */
require_once $helpers_path . '/acf.php';
require_once $helpers_path . '/admin.php';
require_once $helpers_path . '/breadcrumb.php';
require_once $helpers_path . '/contact.php';
require_once $helpers_path . '/excerpt.php';
require_once $helpers_path . '/favicons.php';
require_once $helpers_path . '/image.php';
require_once $helpers_path . '/menu.php';
require_once $helpers_path . '/pagination.php';
require_once $helpers_path . '/schema.php';
require_once $helpers_path . '/seo.php';


/**
 * Require Development Utils.
 */
// require_once $mocks_path . '/pxperfect.php';
// require_once $mocks_path . '/debug.php';
