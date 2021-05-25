<?php
/**
 * --------------------------------------------------------------
 * THEME SUPPORT SETUP - Do not change anything here!
 * --------------------------------------------------------------
 *
 * @package Festival de Verão
 */

 if (!function_exists('fv_after_setup_theme_handler')) {

  function fv_after_setup_theme_handler() {


    /**
     * Loading theme textdomain.
     */
    $locale = apply_filters( 'plugin_locale', get_locale(), THEME_NAME );
    load_textdomain( THEME_NAME, WP_LANG_DIR . '/' . THEME_NAME . '-$locale.mo' );
    load_theme_textdomain(THEME_NAME, get_template_directory() . '/languages');


    /**
     * Register nav menus.
     */
    add_theme_support('menus');

    register_nav_menus(
      [
        'main-menu' => 'Menu principal',
      ]
    );


    /**
     * Add post_thumbnails support.
     */
    add_theme_support('post-thumbnails');
    // add_image_size('foo', 800, 800, true);


    /**
     * Add feed link.
     */
    add_theme_support('automatic-feed-links');


    /**
     * Add support for Post Formats.
     */
    if (THEME_SUPPORT_FORMAT) {
      add_theme_support('post-formats',
        [
          'aside',
          'link',
          'image',
          'quote',
          'status',
        ]
      );
    }


    /**
     * Support The Excerpt on pages.
     */
    if (THEME_PAGE_EXCERPT) {
      add_post_type_support('page', 'excerpt');
    }


    /**
     * Switch default core markup for search form, comment form,
     * and comments to output valid HTML5.
     */
    add_theme_support(
      'html5',
      [
        'search-form',
        'comment-form',
        'comment-list'
      ]
    );


    /**
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

  }

}
add_action('after_setup_theme', 'fv_after_setup_theme_handler');

/*
 * Disables WordPress Rest API for external requests
 */
function fv_disable_rest_api() {
  die('REST API is disabled.');
}
// add_action( 'rest_api_init', 'fv_disable_rest_api', 1 );
