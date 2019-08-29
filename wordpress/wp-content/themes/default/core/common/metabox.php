<?php

/**
 * about page metaboxes config
 */
function wp_kickstart_about_metaboxes() {
  $about = null;
  if ( !empty($_GET['post']) || !empty($_POST['post_ID']) ) {
    if ( !empty($_GET['post']) ) {
      $post_ID = $_GET['post'];
    } else {
      $post_ID = $_POST['post_ID'];
    }
    $post = get_post( $post_ID );
    $slug = $post->post_name;
    if ( $slug === 'sobre' ) {
      $about = [
        'metabox_slug'          => 'about_info',
        'name'                  => 'Sobre o Wordpress Kickstart',
        'cpt_slug'              => 'page',
        'fields'                => [
          [
            'id'                => 'titulo_contador_um',
            'label'             => 'Título do contador 1',
            'type'              => 'text'
          ],
          [
            'id'                => 'contador_um',
            'label'             => 'Contador 1',
            'type'              => 'input',
            'attributes'        => [
              'type' => 'number'
            ]
          ],
          [
            'id'                => 'text_contador_um',
            'label'             => 'Texto do contador 1',
            'type'              => 'textarea'
          ],
          [
            'id'                => 'separator1',
            'type'              => 'separator'
          ],
          [
            'id'                => 'titulo_contador_dois',
            'label'             => 'Título do contador 2',
            'type'              => 'text'
          ],
          [
            'id'                => 'contador_dois',
            'label'             => 'Contador 2',
            'type'              => 'input',
            'attributes'        => [
              'type' => 'number'
            ]
          ],
          [
            'id'                => 'text_contador_dois',
            'label'             => 'Texto do contador 2',
            'type'              => 'textarea'
          ],
          [
            'id'                => 'separator2',
            'type'              => 'separator'
          ],
          [
            'id'                => 'titulo_contador_tres',
            'label'             => 'Título do contador 3',
            'type'              => 'text'
          ],
          [
            'id'                => 'contador_tres',
            'label'             => 'Contador 3',
            'type'              => 'input',
            'attributes'        => [
              'type' => 'number'
            ]
          ],
          [
            'id'                => 'text_contador_tres',
            'label'             => 'Texto do contador 3',
            'type'              => 'textarea'
          ],
          [
            'id'                => 'separator3',
            'type'              => 'separator'
          ],
          [
            'id'          => 'parceiros_id',
            'label'       => __( 'Imagens Parceiros', 'odin' ),
            'type'        => 'image_plupload',
            'description' => __( 'Imagens Parceiros. Tamanho ideal da imagem: 360x250 px', 'odin' )
          ],
        ]
      ];
      return $about;
    }
  }
}

/**
 * metaboxes definitions
 */
function wp_kickstart_metaboxes() {

  // startup list so we can make the select field
  $args = [
    'posts_per_page'   => -1,
    'post_type'        => 'startups',
    'order_by'         => 'title',
    'order'            => 'DESC'
  ];
  $allStartups = get_posts( $args );
  $startuplist = [
    '' => ''
  ];
  foreach ( $allStartups as $startup ) {
    $startuplist[ $startup->ID ] = $startup->post_title;
  }

  // subscribed users so we can make the select field
  $args = [
    // 'role'    => 'subscriber',
    'number'  => -1,
    'fields'  => [
      'ID',
      'display_name'
    ]
  ];
  $allUsers = get_users( $args );
  $userList = [
    '' => ''
  ];
  foreach ( $allUsers as $startupUser ) {
    $userList[ $startupUser->ID ] = $startupUser->display_name;
  }

  /**
   * Listing metaboxes
   */
  $metaboxes = [

    /**
     * Sobre
     */
    wp_kickstart_about_metaboxes(),

    /**
     * Slider
     */
    [
      'metabox_slug'          => 'slider_info',
      'name'                  => 'Outras informações',
      'cpt_slug'              => 'slider',
      'fields'                => [
        [
          'id'                => 'slider_description',
          'label'             => 'Conteúdo do slider',
          'type'              => 'textarea',
          'attributes'        => [
            'placeholder'  => 'Lorem ipsum dolor sit amet, consectetur adispicing elit.',
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'slider_button',
          'label'             => 'Título do botão',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => 'Leia mais',
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'slider_url',
          'label'             => 'Link do slider',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => 'http://wp_kickstart.com.br/noticias',
            'style'        => 'width: 100%'
          ]
        ]
      ]
    ],

    /**
     * Startups
     */
    [
      'metabox_slug'          => 'startup_info',
      'name'                  => 'Outras informações',
      'cpt_slug'              => 'startups',
      'fields'                => [
        [
          'id'                => 'sobre_startup',
          'label'             => 'Sobre',
          'type'              => 'textarea',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'email_startup',
          'label'             => 'Email',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'startup_phone',
          'label'             => 'Telefone de contato',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => '(71) 3333-4444',
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'website_startup',
          'label'             => 'Website',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'pitch_startup',
          'label'             => 'Pitch',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'linkedin_startup',
          'label'             => 'LinkedIn',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'facebook_startup',
          'label'             => 'Facebook',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'instagram_startup',
          'label'             => 'Instagram',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'data_fundacao_startup',
          'label'             => 'Data da fundação',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'tamanho_time_startup',
          'label'             => 'Tamanho do time',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'fase_startup',
          'label'             => 'Fase',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],

        [
          'id'                => 'separator1',
          'type'              => 'separator'
        ],

        [
          'id'                => 'publico_alvo_startup',
          'label'             => 'Público alvo',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'mercado_startup',
          'label'             => 'Mercado principal',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'topicos_startup',
          'label'             => 'Tópicos relacionados',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],

        [
          'id'                => 'separator2',
          'type'              => 'separator'
        ],

        [
          'id'                => 'cep_startup',
          'label'             => 'CEP',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'startup_address',
          'label'             => 'Endereço físico',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => 'Rua Lorem Ipsum, 123',
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'endereco_numero_startup',
          'label'             => 'Número',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'endereco_complemento_startup',
          'label'             => 'Complemento',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'endereco_bairro_startup',
          'label'             => 'Bairro',
          'type'              => 'text',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'startup_lat',
          'label'             => 'Latitude',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => '-12.9811142',
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'startup_lng',
          'label'             => 'Logitude',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'  => '-38.4373875',
            'style'        => 'width: 100%'
          ]
        ],

        [
          'id'                => 'separator3',
          'type'              => 'separator'
        ],

        [
          'id'                => 'sou_do_time',
          'label'             => 'Faço parte do time da <strong>startup</strong>',
          'type'              => 'select',
          'attributes'        => [
            'style'        => 'width: 100%'
          ],
          'options'         => [
            'nao' => 'Não',
            'sim' => 'Sim'
          ]
        ],
        [
          'id'                => 'sou_fundador',
          'label'             => 'Sou um dos fundadores da <strong>startup</strong>',
          'type'              => 'select',
          'attributes'        => [
            'style'        => 'width: 100%'
          ],
          'options'         => [
            'nao' => 'Não',
            'sim' => 'Sim'
          ]
        ],
        [
          'id'                => 'termos_de_uso',
          'label'             => 'Estou de acordo com os <a href="javascript:void(0)" class="text-blue-light font-bold">Termos de Uso</a>',
          'type'              => 'select',
          'attributes'        => [
            'style'        => 'width: 100%'
          ],
          'options'         => [
            'nao' => 'Não',
            'sim' => 'Sim'
          ]
        ],

        [
          'id'                => 'separator4',
          'type'              => 'separator'
        ],

        [
          'id'                => 'proprietario_startup',
          'label'             => 'Usuário com propriedade sobre a startup',
          'type'              => 'select',
          'options'           => $userList,
          'attributes'        => [
            'style'     => 'width: 100%'
          ],
        ],
      ]
    ],

    /**
     * Oportunidadaes
     */
    [
      'metabox_slug'          => 'oportunidades_info',
      'name'                  => 'Outras informações',
      'cpt_slug'              => 'oportunidades',
      'fields'                => [
        [
          'id'            => 'startup_relacionada',
          'label'         => 'Qual Startup está oferecendo esta vaga?',
          'type'          => 'select',
          'options'       => $startuplist,
          'attributes'    => [
            // 'disabled' => 'disabled'
            'style'     => 'width: 100%'
          ],
        ],
        [
          'id'                => 'faixa_salarial',
          'label'             => 'Faixa salarial',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'   => 'de R$ 2.000 a R$ 2.500,00',
            'style'         => 'width: 100%'
          ]
        ],
        [
          'id'                => 'contratacao',
          'label'             => 'Tipo de contratação',
          'type'              => 'text',
          'attributes'        => [
            'placeholder'   => 'CLT',
            'style'         => 'width: 100%'
          ]
        ],
        [
          'id'                => 'numero_vagas',
          'label'             => 'Número de vagas',
          'type'              => 'text',
          'attributes'        => [
            'style'  => 'width: 100%;'
          ]
        ],
        [
          'id'                => 'descricao',
          'label'             => 'Descrição da vaga',
          'type'              => 'textarea',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'requisitos',
          'label'             => 'Requisitos da vaga',
          'type'              => 'textarea',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ],
        [
          'id'                => 'desejavel',
          'label'             => 'Desejável para a vaga',
          'type'              => 'textarea',
          'attributes'        => [
            'style'        => 'width: 100%'
          ]
        ]
      ]
    ],

    /**
     * Fórum
     */
    [
      'metabox_slug'          => 'forum_info',
      'name'                  => 'Contagem de visualizações',
      'cpt_slug'              => 'forum',
      'fields'                => [
        [
          'id'            => 'total_views',
          'label'         => 'Visualizações',
          'type'          => 'input',
          'attributes'    => [
            'type'      => 'number',
            'disabled'  => 'disabled',
            'style'     => 'width: 200px; max-width: 100%;'
          ]
        ],
      ]
    ],

    /**
     * Agenda de Eventos
     */
    [
      'metabox_slug'          => 'agenda_info',
      'name'                  => 'Outras informações',
      'cpt_slug'              => 'agenda',
      'fields'                => [
        [
          'id'                => 'data',
          'label'             => 'Data do evento',
          'type'              => 'input',
          'attributes'        => [
            'type'          => 'date',
            'style'         => 'width: 200px; max-width: 100%;'
          ]
        ],
        [
          'id'                => 'hora',
          'label'             => 'Horário do evento',
          'type'              => 'input',
          'attributes'        => [
            'type'          => 'time',
            'style'         => 'width: 200px; max-width: 100%;'
          ]
        ],
        [
          'id'                => 'local',
          'label'             => 'Nome do local do evento',
          'type'              => 'text',
          'attributes'      => [
            'style'      => 'width: 200px; max-width: 100%;'
          ]
        ],
        [
          'id'                => 'event_lat',
          'label'             => 'Latitude do local do evento no mapa',
          'type'              => 'text',
          'attributes'      => [
            'style'       => 'width: 200px; max-width: 100%;',
            'placeholder' => '-12.9811142'
          ]
        ],
        [
          'id'                => 'event_lng',
          'label'             => 'Longitude do local do evento no mapa',
          'type'              => 'text',
          'attributes'      => [
            'style'       => 'width: 200px; max-width: 100%;',
            'placeholder' => '-38.4373875'
          ]
        ]
      ]
    ],

    /**
     * Números
     */
    [
      'metabox_slug'          => 'agenda_info',
      'name'                  => 'Informações',
      'cpt_slug'              => 'numeros',
      'fields'                => [
        [
          'id'                => 'numero',
          'label'             => 'Número de destaque',
          'type'              => 'input',
          'attributes'        => [
            'type'       => 'number',
            'max'        => 99,
            'min'        => 1,
            'style'      => 'width: 200px; max-width: 100%;'
          ]
        ],
        [
          'id'                => 'local',
          'label'             => 'Nome do local do evento',
          'type'              => 'textarea',
          'attributes'        => [
            'style'      => 'width: 100%;'
          ]
        ]
      ]
    ],

    /**
     * Apoiadores
     */
    [
      'metabox_slug'          => 'agenda_info',
      'name'                  => 'Informações',
      'cpt_slug'              => 'apoiadores',
      'fields'                => [
        [
          'id'                => 'link',
          'label'             => 'Link do apoiador',
          'type'              => 'text',
          'attributes'        => [
            'style'       => 'width: 100%;',
            'placeholder' => 'https://republicainterativa.com.br'
          ]
        ]
      ]
    ],

  ];

  // echo '<pre>' . print_r($metaboxes, true) . '</pre>';die;

  /**
   * Instance metaboxes and set their fields
   */
  foreach ( $metaboxes as $metabox ) {

    /**
     * It makes a dynamic variable so we link the loop to the post type
     */
    $variable_name = $metabox['cpt_slug'] . '_metabox';

    /**
     * Metabox instance
     */
    $$variable_name = new Odin_Metabox(
      $metabox['metabox_slug'],
      $metabox['name'],
      $metabox['cpt_slug'],
      'normal',
      'high'
    );

    /**
     * Fields
     */
    $$variable_name->set_fields( $metabox['fields'] );
  }

}
add_action( 'init', 'wp_kickstart_metaboxes' );
