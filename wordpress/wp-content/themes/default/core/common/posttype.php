<?php
/**
 * CPT definitions
 *
 * @package Festival de Verão
 */

/*
 * Initialize Custom Post Types
 */
function fv_init_cpts() {

  $cpts = [
    [
      'name'              => 'Kckstart',
      'singular_name'     => 'Kckstart',
      'slug'              => 'kickstart',
      'gender'            => 'o',
      'fields'            => [ 'title', 'thumbnail' ],
      'taxonomy'          => [  ],
      'icon'              => 'dashicons-image-flip-horizontal',
      'has_archive'       => false,
      'position'          => 3,
      'exclude_search'    => true
    ]
  ];

  if ( !empty( $cpts ) ) {
    foreach ( $cpts as $cpt ) {

      $name                     = $cpt['name'];
      $singular_name            = $cpt['singular_name'];
      $slug                     = $cpt['slug'];
      $gender                   = $cpt['gender'];
      $fields                   = $cpt['fields'];
      $taxonomy                 = $cpt['taxonomy'];
      $icon                     = $cpt['icon'];
      $archive                  = $cpt['has_archive'];
      $position                 = $cpt['position'];
      $search                   = $cpt['exclude_search'];

      $labels = [
        'name'                  => $name,
        'singular_name'         => $singular_name,
        'menu_name'             => $name,
        'name_admin_bar'        => $name,
        'archives'              => $name,
        'parent_item_colon'     => $singular_name . ' Pai',
        'all_items'             => 'Tod' . $gender . 's ' . $gender . 's ' . $name,
        'add_new_item'          => 'Add nov' . $gender . ' ' . $singular_name,
        'add_new'               => 'Add Nov' . $gender,
        'new_item'              => 'Nov' . $gender . ' ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'update_item'           => 'Atualizar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'search_items'          => 'Procurar ' . $singular_name,
        'not_found'             => 'Não encontrado',
        'not_found_in_trash'    => 'Não encontrado na lixeira',
        'featured_image'        => 'Imagem de destaque',
        'set_featured_image'    => 'Inserir imagem de destaque',
        'remove_featured_image' => 'Remover imagem de destaque',
        'use_featured_image'    => 'Usar como imagem de destaque',
      ];

      $args = [
        'label'                 => $name,
        'description'           => 'Tipo de posts para ' . $gender . 's ' . $name,
        'labels'                => $labels,
        'supports'              => $fields,
        'taxonomies'            => $taxonomy,
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => $position,
        'menu_icon'             => $icon,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => $archive,
        'exclude_from_search'   => $search,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
      ];

      register_post_type( $slug, $args );
    }
  }
}
add_action( 'init', 'fv_init_cpts' );
