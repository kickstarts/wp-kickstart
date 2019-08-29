<?php


/**
 * Check current URL
 */
function wp_kickstart_active_page( $menu_item ) {
  $actual_link = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if ( $actual_link == WP_SITE_URL . '/' . $menu_item['link'] ) {
    return 'activated';
  }

  return '';
}


/**
 * Render Main Navigation.
 */
function wp_kickstart_navigation( $type = 'header' ) {
  $pages = [
    [
      'name'      => __( 'Sobre', 'wp_kickstart' ),
      'subtitle'  => __( 'O ecossistema', 'wp_kickstart' ),
      'link'      => 'sobre/'
    ],
    [
      'name'      => __( 'Oportunidades', 'wp_kickstart' ),
      'subtitle'  => __( 'de trabalho', 'wp_kickstart' ),
      'link'      => 'oportunidades/'
    ],
    [
      'name'      => __( 'Blog', 'wp_kickstart' ),
      'subtitle'  => __( 'Acompanhe', 'wp_kickstart' ),
      'link'      => 'blog/'
    ],
    [
      'name'      => __( 'Fórum', 'wp_kickstart' ),
      'subtitle'  => __( 'Da comunidade', 'wp_kickstart' ),
      'link'      => 'forum/'
    ],
    [
      'name'      => __( 'Agenda de eventos', 'wp_kickstart' ),
      'subtitle'  => __( 'Fique ligado', 'wp_kickstart' ),
      'link'      => 'agenda/'
    ],
    [
      'name'      => __( 'Cadastre-se', 'wp_kickstart' ),
      'subtitle'  => __( 'Faça parte', 'wp_kickstart' ),
      'link'      => 'cadastre-se/'
    ],
    [
      'name'      => __( 'Minha conta', 'wp_kickstart' ),
      'subtitle'  => __( 'Acesse', 'wp_kickstart' ),
      'link'      => 'minha-conta/'
    ],
    [
      'name'      => __( 'Sair', 'wp_kickstart' ),
      'subtitle'  => __( 'Logout', 'wp_kickstart' ),
      'link'      => wp_logout_url( (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"],'?') )
    ]
  ];

  $total_pages = count( $pages ); ?>

  <nav class="nav">
    <ul class="nav-list <?=( $type === 'header' ) ? 'at-header' : 'at-footer'?>"> <?php
      $delay = 0;
      foreach ( $pages as $index => $page ) {
        $href = WP_SITE_URL . '/' . $page['link'];
        if ( is_user_logged_in() && $page['subtitle'] == 'Logout' ) {
          $href = $page['link'];
        }
        if ( is_user_logged_in() && $page['link'] == 'cadastre-se/' ) {
          continue;
        }
        if ( !is_user_logged_in() && $page['subtitle'] == 'Logout' ) {
          continue;
        } ?>
        <li class="nav-item wow fadeInRight delay-<?=$delay?> <?=($index === $total_pages - 1) ? 'last-item' : ''?>">
          <a href="<?=$href?>" class="nav-link <?=wp_kickstart_active_page( $page )?>">
            <p class="menu-title text-white uppercase font-bold <?=( $type === 'footer' ) ? 'text-sm' : 'text-md'?>"><?=$page['name']?></p>
            <p class="menu-subtitle text-blue-light uppercase text-sm font-bold"><?=$page['subtitle']?></p>
          </a>
        </li> <?php
        $delay += 100;
      } ?>
    </ul>
  </nav> <?php
}
