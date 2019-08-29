<?php

/**
 * SEO utils
 */
function wp_kickstart_seo_utils() {

  /**
   * SEO variables definitions
   */
  $mtitle_default = get_bloginfo('name');
  $title_default  = get_bloginfo('name');
  $home_default   = WP_SITE_URL;
  $keys_default   = '';
  $link_default   = WP_SITE_URL;
  $desc_default   = get_bloginfo('description');
  $image_default  = WP_THEME_URL . '/screenshot.png';
  if ( is_single() || is_page() ) {
    global $post;
    $title_default  = get_the_title($post->ID);
    $link_default   = get_permalink();
    $desc_default   = get_post($post->ID);
    $desc_default   = strip_tags( $desc_default->post_content );
    $desc_default   = substr( $desc_default, 0, 250 );
    if ( has_post_thumbnail() ){
      $image_ID      = get_post_thumbnail_id($post->ID);
      $image_default = wp_get_attachment_image_src($image_ID, 'large');
      $image_default = $image_default[0];
    }
  }

  global $post;
  if ( is_single() || is_singular() ) {
    $posttags = wp_get_post_tags( $post->ID );
  }

  /**
   * Robots definitions
   */
  if ( is_single() || is_page() || is_category() || is_home() ) { ?>
    <meta name="robots" content="all,noodp" /> <?php
  }
  if ( is_archive() ) { ?>
    <meta name="robots" content="noarchive,noodp" /> <?php
  }
  if ( is_search() || is_404() ) { ?>
    <meta name="robots" content="noindex,noarchive" /> <?php
  } ?>

  <meta name="copyright" content="©<?=date( 'Y' ); ?> Todos os direitos reservados para <?=$title_default?>">
  <meta name="author" content="República Interativa">
  <meta name="name" content="<?=$title_default?>">
  <meta name="description" content="<?=$desc_default?>">

  <!-- Schema.org -->
  <meta itemprop="name" content="<?=$title_default?>">
  <meta itemprop="description" content="<?=$desc_default?>">
  <meta itemprop="image" content="<?=$image_default?>">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@wp_kickstart">
  <meta name="twitter:title" content="<?=$title_default?>">
  <meta name="twitter:description" content="<?=$desc_default?>">
  <meta name="twitter:creator" content="@wp_kickstart">
  <meta name="twitter:image" content="<?=$image_default?>">

  <!-- Facebook Open Graph -->
  <meta property="og:title" content="<?=$title_default?>"/>
  <meta property="og:description" content="<?=$desc_default?>">
  <meta property="og:image" itemprop="image" content="<?=$image_default?>"/>
  <meta property="og:url" content="<?=$link_default?>"/>
  <meta property="og:site_name" content="<?=$title_default?>"/>
  <meta property="og:locale" content="pt-BR" />
  <meta property="og:type" content="website" />
  <meta property="fb:app_id" content="419134255558860" />

  <!-- Google Meta Data -->
  <meta name="google-site-verification" content="<?=GOOGLE_VERIFICATION?>" />
  <meta name="geo.region" content="BR-BA" />
  <meta name="geo.placename" content="Salvador" />
  <meta name="geo.position" content="-12975793,-38485107" />
  <meta name="ICBM" content="-12975793,-38485107" />

  <!-- Dublin Core Meta Data -->
  <meta name="dc.language" content="PT-BR">
  <meta name="dc.creator" content="<?=$mtitle_default?>">
  <meta name="dc.publisher" content="<?=$mtitle_default?>">
  <meta name="dc.source" content="<?=$home_default?>">
  <meta name="dc.relation" content="<?=$link_default?>">
  <meta name="dc.title" content="<?=$title_default?>">
  <meta name="dc.keywords" content="<?=$keys_default?>, <?php if(!empty($posttags)){foreach($posttags as $tag){echo $tag->name . ', ';}}; ?>">
  <meta name="dc.subject" content="<?=$desc_default?>">
  <meta name="dc.description" content="<?=$desc_default?>"> <?php
}
