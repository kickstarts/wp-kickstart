<?php
/**
 * --------------------------------------------------------------
 * ADMIN PANEL SETUP - Do not change anything here!
 * --------------------------------------------------------------
 *
 * @package Wordpress Kickstart
 */

 if ( is_user_logged_in() && is_admin() ) {
  $currentuser = wp_get_current_user();
  if ( $currentuser->roles[0] == 'subscriber' ) {
    // wp_die( 'Você não possui permissão para acessar esta página.' );
  }
}


/**
 * Manage items from admin bar.
 */
function wp_kickstart_admin_bar() {
  global $wp_admin_bar;

  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('about');
  $wp_admin_bar->remove_menu('wporg');
  $wp_admin_bar->remove_menu('documentation');
  $wp_admin_bar->remove_menu('support-forums');
  $wp_admin_bar->remove_menu('feedback');
  $wp_admin_bar->remove_menu('view-site');
  $wp_admin_bar->remove_menu('updates');
  $wp_admin_bar->remove_menu('new-content');
  $wp_admin_bar->remove_menu('comments');

  $wp_admin_bar->add_menu(
    [
      'id'    => 'new',
      'title' => 'Adicionar'
    ]
  );
  $wp_admin_bar->add_menu(
    [
      'parent' => 'new',
      'id'     => 'novastartup',
      'title'  => 'Startup',
      'href'   => admin_url().'post-new.php?post_type=startups'
    ]
  );
  $wp_admin_bar->add_menu(
    [
      'parent' => 'new',
      'id'     => 'novopost',
      'title'  => 'Post',
      'href'   => admin_url().'post-new.php?post_type=post'
    ]
  );
  $wp_admin_bar->add_menu(
    [
      'parent' => 'new',
      'id'     => 'novaoportunidade',
      'title'  => 'Oportunidade',
      'href'   => admin_url().'post-new.php?post_type=oportunidades'
    ]
  );
  $wp_admin_bar->add_menu(
    [
      'parent' => 'new',
      'id'     => 'novoevento',
      'title'  => 'Evento',
      'href'   => admin_url().'post-new.php?post_type=agenda'
    ]
  );
}
add_action('wp_before_admin_bar_render', 'wp_kickstart_admin_bar');


/**
 * Hide update notice of wordpress version.
 */
function wp_kickstart_hide_msg() {
  remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_menu','wp_kickstart_hide_msg');


/**
 * Hide "help" guide.
 */
function wp_kickstart_hide_help() {
  echo '<style type="text/css">#contextual-help-link-wrap { display: none !important; }</style>';
}
add_action('admin_head', 'wp_kickstart_hide_help');


/**
 * Change the footer text
 */
function wp_kickstart_remove_footer_admin() {
  echo "&copy;". date('Y') . ' - ' . get_bloginfo('name') . " - Todos os Direitos Reservados.";
}
add_filter('admin_footer_text', 'wp_kickstart_remove_footer_admin');


/**
 * Remove version from footer.
 */
function wp_kickstart_change_footer_version() {
    return 'Orgulhosamente desenvolvido pela: <a href="http://www.republicainterativa.com.br" target="_blank" title="República Interativa">República Interativa</a>';
}
add_filter('update_footer', 'wp_kickstart_change_footer_version', 9999);


/**
 * Remove meta boxes from posts.
 */
function wp_kickstart_remove_meta_boxes() {
  // Post format meta box
  remove_meta_box('formatdiv', 'post', 'normal');
  // Comments meta box
  remove_meta_box('commentsdiv', 'post', 'normal');
  // Revisions meta box
  remove_meta_box('revisionsdiv', 'post', 'normal');
  // Author meta box
  remove_meta_box('authordiv', 'post', 'normal');
  // Slug meta box
  remove_meta_box('slugdiv', 'post', 'normal');
  // Excerpt meta box
  remove_meta_box('postexcerpt', 'post', 'normal');
  // Trackbacks meta box
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  // Comment status meta box
  remove_meta_box('commentstatusdiv', 'post', 'normal');
}
add_action('admin_menu', 'wp_kickstart_remove_meta_boxes');


/**
 * Remove widgets dashboard.
 */
function wp_kickstart_remove_widgets_admin() {
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_secondary', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'wp_kickstart_remove_widgets_admin');


/**
 * Disable Gutenberg
 */

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);


/**
 * Set the color based on post status.
 */
function wp_kickstart_posts_status_color() { ?>
  <style>
    .status-draft   { background: #FCE3F2 !important; }
    .status-pending { background: #CBDFF2 !important; }
    .status-publish { /* Default colors */ }
    .status-future  { background: #C6EBF5 !important; }
    .status-private { background: #F2D46F !important; }
    .status-trash   { background: #F2D46F !important; }
  </style> <?php
}
add_action('admin_footer', 'wp_kickstart_posts_status_color');


/**
 * Remove tabs from menu.
 */
function wp_kickstart_remove_menus() {
  global $menu;
  global $current_user;

  wp_get_current_user();

  $granted_users = array('root', 'republicainterativa');

  if ( !(is_admin() && in_array($current_user->user_login, $granted_users)) ) {

    // Remove ACF Menu
    remove_menu_page('edit.php?post_type=acf-field-group');

    // Remove Core Menus
    $restricted = array(
      // __('Dashboard'),
      // __('Posts'),
      // __('Pages'),
      __('Settings'),
      __('Links'),
      __('Appearance'),
      __('Tools'),
      __('Plugins'),
      __('Comments')
    );

    end ($menu);

    while (prev($menu)) {
      $value = explode(' ',$menu[key($menu)][0]);
      if (in_array($value[0] != NULL?$value[0]:"" , $restricted)) {
        unset($menu[key($menu)]);
      }
    }
  }
}
add_action('admin_menu', 'wp_kickstart_remove_menus');


/**
 * Hide "Options" tab from admin.
 */
function wp_kickstart_remove_screen_options_tab() {
  return false;
}
add_filter('screen_options_show_screen', 'wp_kickstart_remove_screen_options_tab');


/**
 * Remove items from user profile.
 */
function wp_kickstart_change_contact_methods($contactmethods) {
  unset($contactmethods['aim']);
  unset($contactmethods['yim']);
  unset($contactmethods['jabber']);

  return $contactmethods;
}
add_filter('user_contactmethods', 'wp_kickstart_change_contact_methods', 10, 1);


/**
 * User opts cleaning
 */
function wp_kickstart_remove_personal_options(){ ?>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('form#your-profile > h2:first').remove();
      $('form#your-profile tr.user-rich-editing-wrap').remove();
      $('form#your-profile tr.user-admin-color-wrap').remove();
      $('form#your-profile tr.user-comment-shortcuts-wrap').remove();
      $('form#your-profile tr.user-admin-bar-front-wrap').remove();
      $('form#your-profile tr.user-language-wrap').remove();
    });
  </script> <?php
}
add_action('admin_head','wp_kickstart_remove_personal_options');


/**
 * Disable auto update of plugins.
 */
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', function($a) {return null;}, 999);


/**
 * Remove Welcome Panel.
 */
remove_action('welcome_panel', 'wp_welcome_panel');


/**
 * Dashboard Setup Panel
 */
function wp_kickstart_dashboard_widgets() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget(
    'custom_help_widget',
    'Bem vindo ao painel da República Interativa', 'wp_kickstart_dashboard_help'
  );
}
add_action('wp_dashboard_setup', 'wp_kickstart_dashboard_widgets');

// Callback for the previous action
function wp_kickstart_dashboard_help() {
  echo '<p>Aqui você poderá gerenciar todo o conteúdo do site.</p><p>Qualquer dúvida, entre em contato através do email requipe@republicainterativa.com</p><p>Este site é mantido com a tecnologia do sistema WordPress e foi desenvolvido pela <a href="http://www.republicainterativa.com.br" target="_blank">República Interativa</a></p>';
}
