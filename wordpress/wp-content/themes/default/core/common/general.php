<?php
/**
 * General Functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Wordpress Kickstart
 */

 /**
  * Load async scripts
  */
function wp_kickstart_async_scripts($url) {
  if ( strpos( $url, '#asyncload') === false )
    return $url;
  else if ( is_admin() )
    return str_replace( '#asyncload', '', $url );
  else
    return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'wp_kickstart_async_scripts', 11, 1 );


/**
 * Load Scripts.
 */
function wp_kickstart_enqueue_scripts() {

  // WP theme css
  wp_enqueue_style('activation-css', get_stylesheet_uri(), [], null, 'all');

  // Google Fonts
  wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Quicksand:400,700|Source+Sans+Pro:400,700', [], null, false);
  wp_enqueue_style( 'icons', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', [], null, false);

  // Main css file
  wp_enqueue_style('main-css', WP_STYLE_URL . '/main.min.css?vrs='.filemtime(get_template_directory().'/assets/styles/main.min.css'), [], null, false);

  // Google Maps
  if ( is_home() || is_singular('oportunidades') || is_singular( 'agenda' ) || is_singular( 'startups' ) || is_page( 'criar-startup' ) || is_page( 'criar-player' ) || is_page( 'minha-conta' ) ) {
    wp_register_script('googleapis-js', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_API_KEY.'#asyncload', [], null, false);
    wp_enqueue_script('googleapis-js');
  }

  // Modernizr
  wp_register_script('modernizr-js', WP_SCRIPT_URL . '/vendors/modernizr.min.js', [], null, false);
  wp_enqueue_script('modernizr-js');

  // remove unused script
  wp_deregister_script('wp-embed');
  wp_deregister_script('jquery');

  // enqueue compatible jquery version into vendors
  wp_register_script('jquery', WP_SCRIPT_URL . '/vendors/vendors.min.js', [], null, true);
  wp_enqueue_script('jquery');

  // Main
  wp_register_script('main-js', WP_SCRIPT_URL . '/main.min.js', [], null, true);
  $ajax_url = admin_url('admin-ajax.php');
  wp_localize_script( 'main-js', 'ajax_url', $ajax_url );
  wp_enqueue_script( 'main-js' );

  // Enqueue comments script
  if ( is_singular( 'forum' ) && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action('wp_enqueue_scripts', 'wp_kickstart_enqueue_scripts', 1);


/**
 * Load admin stuff
 */
function wp_kickstart_custom_wp_admin_style() {
  wp_register_style( 'custom_wp_admin_css', WP_STYLE_URL . '/admin.min.css?vrs='.filemtime(get_template_directory().'/assets/styles/admin.min.css'), false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'wp_kickstart_custom_wp_admin_style' );


/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 */
function wp_kickstart_flush_rewrite() {
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'wp_kickstart_flush_rewrite');
