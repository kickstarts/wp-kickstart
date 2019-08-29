<?php

function wp_kickstart_general_opts() {

  /**
   * @ID títles
   */
  $title_fields = [
    [
      'id'            => 'some_id_goes_here',
      'label'         => 'Label goes here',
      'description'   => 'Description goes here',
      'type'          => 'text'
    ]
  ];

  /**
   * @ID social
   */
  $social_fields = [
    [
      'id'            => 'social_media_facebook',
      'label'         => 'Facebook',
      'description'   => '',
      'type'          => 'text',
      'attributes'    => [
        'placeholder' => 'https://facebook.com/{user}'
      ]
    ],
    [
      'id'            => 'social_media_instagram',
      'label'         => 'Instagram',
      'description'   => '',
      'type'          => 'text',
      'attributes'    => [
        'placeholder' => 'https://instagram.com/{user}'
      ]
    ],
    [
      'id'            => 'social_media_twitter',
      'label'         => 'Twitter',
      'description'   => '',
      'type'          => 'text',
      'attributes'    => [
        'placeholder' => 'https://twitter.com/{user}'
      ]
    ],
  ];

  /**
   * Options page definition
   */
  $settings = new Odin_Theme_Options(
    'general-opts',
    'Opções gerais',
    'manage_options'
  );

  /**
   * Tabs registering
   */
  $tabs = [
    [
      'id'      => 'titles',
      'title'   => 'Titles'
    ],
    [
      'id'      => 'social',
      'title'   => 'Socials'
    ]
  ];
  $settings->set_tabs( $tabs );

  /**
   * Fields setting
   */
  $content = [
    'titles_subtitles' => [
      'tab'       => 'titles',
      'title'     => 'Titles',
      'fields'    => $title_fields
    ],
    'social_media' => [
      'tab'       => 'social',
      'title'     => 'Socials',
      'fields'    => $social_fields
    ]
  ];
  $settings->set_fields( $content );

}
add_action( 'init', 'wp_kickstart_general_opts', 1 );
