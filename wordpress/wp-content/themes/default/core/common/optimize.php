<?php
/**
 * Optimization Functions and definitions
 *
 * @package Wordpress Kickstart
 */


/**
 * Generates the title of the site optimized for SEO.
 */
function wp_kickstart_seo_wp_title( $title, $sep ) {
  global $page, $paged;

  if ( is_feed() ) {
    return $title;
  }

  // Add the blog name
  $title .= get_bloginfo( 'name' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ){
    $title .= " $sep $site_description";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " $sep " . sprintf( 'P&aacute;gina %s', max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'wp_kickstart_seo_wp_title', 10, 2 );


/**
 * Cleanup wp_head().
 */
function wp_kickstart_head_cleanup() {
  // category feeds.
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  // post and comment feeds.
  remove_action( 'wp_head', 'feed_links', 2 );
  // EditURI link.
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer.
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // index link.
  remove_action( 'wp_head', 'index_rel_link' );
  // previous link.
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link.
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts.
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version.
  remove_action( 'wp_head', 'wp_generator' );

  // Emoji's
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'wp_kickstart_head_cleanup' );


/**
 * Remove WP version from RSS.
 */
add_filter( 'the_generator', '__return_false' );


/**
 * Remove injected CSS from gallery.
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Add rel="nofollow" and remove rel="category".
 */
function wp_kickstart_modify_category_rel( $text ) {
  $search = array( 'rel="category"', 'rel="category tag"' );
  $text = str_replace( $search, 'rel="nofollow"', $text );

  return $text;
}
add_filter( 'wp_list_categories', 'wp_kickstart_modify_category_rel' );
add_filter( 'the_category', 'wp_kickstart_modify_category_rel' );


/**
 * Add rel="nofollow" and remove rel="tag".
 */
function wp_kickstart_modify_tag_rel( $taglink ) {
  return str_replace( 'rel="tag">', 'rel="nofollow">', $taglink );
}
add_filter( 'wp_tag_cloud', 'wp_kickstart_modify_tag_rel' );
add_filter( 'the_tags', 'wp_kickstart_modify_tag_rel' );


/**
 * Add feed link.
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Remove WP Top bar (front-end)
 */
show_admin_bar(false);


/**
 * Remove default image sizes here
 */
function wp_kickstart_remove_default_images( $sizes ) {
  unset( $sizes['small']);
  unset( $sizes['medium']);
  unset( $sizes['large']);
  unset( $sizes['medium_large']);
  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'wp_kickstart_remove_default_images' );
