<?php
  /**
   * The Header for our theme.
   *
   * Displays all of the <head> section and everything up till .main div
   *
   * @package Festival de Verão
   */ ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> <?php theme_html_tag_schema(); ?>>

<head>

  <meta charset="<?php get_bloginfo('charset'); ?>" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta name="format-detection" content="telephone=no">

  <!-- Chrome / Firefox OS / Opera -->
  <meta name="theme-color" content="#303B58">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#303B58">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="<?php get_bloginfo('name'); ?>">

  <!-- SEO -->
  <?php fv_seo_utils(); ?>

  <!-- Icons -->
  <?php fv_favicons(); ?>

  <link type="text/plain" rel="author" href="<?php WP_THEME_URL?>/humans.txt">
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php get_bloginfo('pingback_url'); ?>" /> <?php

  /**
   * Theme options
   */
  $GLOBALS['titles'] = get_option( 'titles' );

  wp_head();
?>
</head>

<body <?body_class()?>>

  <!--[if lte IE 10]>
    <p class="browserupgrade">Você está utilizando um navegador <strong>defasado</strong>. Por favor <a href="http://browsehappy.com/">atualize o seu navegador</a> para ter uma experiência completa em nosso website.</p>
  <![endif]-->

  <header class="header-wrapper <?php if (!is_home()) echo 'borded-header'; ?>">
    <?get_template_part('includes/header')?>
  </header>

  <!-- closes in footer.php -->
  <section class="site-wrapper"> <?php
    if (!is_home()) get_template_part('includes/content', 'breadcrumbs');
