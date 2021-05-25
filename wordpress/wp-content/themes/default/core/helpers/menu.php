<?php


/**
 * Check current URL
 */
function fv_active_page( $menu_item ) {
  $actual_link = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if ( $actual_link == WP_SITE_URL . '/' . $menu_item['link'] ) {
    return 'activated';
  }

  return '';
}


/**
 * Render Main Navigation.
 */
function fv_navigation( $type = 'header' ) {
  $pages = [
    [
      'name'      => __( 'Sobre', 'fv' ),
      'subtitle'  => __( 'O ecossistema', 'fv' ),
      'link'      => 'sobre/'
    ],
    [
      'name'      => __( 'Oportunidades', 'fv' ),
      'subtitle'  => __( 'de trabalho', 'fv' ),
      'link'      => 'oportunidades/'
    ],
    [
      'name'      => __( 'Blog', 'fv' ),
      'subtitle'  => __( 'Acompanhe', 'fv' ),
      'link'      => 'blog/'
    ],
    [
      'name'      => __( 'Fórum', 'fv' ),
      'subtitle'  => __( 'Da comunidade', 'fv' ),
      'link'      => 'forum/'
    ],
    [
      'name'      => __( 'Agenda de eventos', 'fv' ),
      'subtitle'  => __( 'Fique ligado', 'fv' ),
      'link'      => 'agenda/'
    ],
    [
      'name'      => __( 'Cadastre-se', 'fv' ),
      'subtitle'  => __( 'Faça parte', 'fv' ),
      'link'      => 'cadastre-se/'
    ],
    [
      'name'      => __( 'Minha conta', 'fv' ),
      'subtitle'  => __( 'Acesse', 'fv' ),
      'link'      => 'minha-conta/'
    ],
    [
      'name'      => __( 'Sair', 'fv' ),
      'subtitle'  => __( 'Logout', 'fv' ),
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
          <a href="<?=$href?>" class="nav-link <?=fv_active_page( $page )?>">
            <p class="menu-title text-white uppercase font-bold <?=( $type === 'footer' ) ? 'text-sm' : 'text-md'?>"><?=$page['name']?></p>
            <p class="menu-subtitle text-blue-light uppercase text-sm font-bold"><?=$page['subtitle']?></p>
          </a>
        </li> <?php
        $delay += 100;
      } ?>
    </ul>
  </nav> <?php
}
