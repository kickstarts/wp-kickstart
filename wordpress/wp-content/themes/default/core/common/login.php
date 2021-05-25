<?php
/**
 * Optimization Functions and definitions
 *
 * @package Festival de Verão
 */


/**
 * Unauthorized Admin Login
 */
function fv_unauthorized_access() {
  $custom_error_msgs = array(
    '<strong>Ops!</strong>: Algo deu errado!',
  );
  return $custom_error_msgs[array_rand($custom_error_msgs)];;
}
add_filter( 'login_errors', 'fv_unauthorized_access' );


/**
 * Login style
 */
function fv_custom_login_style() {
  wp_register_style( 'custom_wp_admin_css', WP_STYLE_URL . '/admin.min.css?vrs='.filemtime(get_template_directory().'/assets/styles/admin.min.css'), false, '1.0.0' );
  wp_enqueue_style( 'core', WP_THEME_URL . '/assets/core/assets/css/login.css?ver=4.1.1', false );
}
add_action( 'login_enqueue_scripts', 'fv_custom_login_style', 10 );
