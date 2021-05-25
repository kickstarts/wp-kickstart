<?php
/**
 * Theme Configuration.
 *
 * Sets up the theme, which are used in the theme.
 *
 * @package Festival de Verão
 */

$theme = wp_get_theme();
if(!empty($theme['Template'])) {
    $theme = wp_get_theme($theme['Template']);
}


/**
 * Theme Settings.
 */
define('THEME_NAME', $theme['Name']);
define('THEME_VERSION', $theme['Version']);
define('THEME_SUPPORT_FORMAT', false);
define('THEME_PAGE_EXCERPT', false);
define('THEME_CONTENT_WIDTH', '680');
define('THEME_QUERY_LIMIT', 12);


/**
 * Google Settings.
 */
define('GOOGLE_ANALYTICS_UA', '');
define('GOOGLE_VERIFICATION', '');
define('GOOGLE_API_KEY', '');


