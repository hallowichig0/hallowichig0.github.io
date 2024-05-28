<?php
new \Kirki\Panel(
	'footer',
	[
		'priority'    => 30,
		'title'       => esc_html__( 'Footer', 'sage' ),
		'description' => esc_html__( 'customize Footer panels', 'sage' ),
	]
);

new \Kirki\Section(
    'footer_copyright',
    [
        'title'       => esc_html__( 'Copyright', 'sage' ),
        'panel'       => 'footer',
        'priority'    => 10,
    ],
);

    new \Kirki\Field\Text(
        [
            'settings'    => 'footer_copyrightText_setting',
            'label'       => __( 'Copyright Text', 'sage' ),
            'section'     => 'footer_copyright',
            'default'  => esc_html__( 'Bootstrap 2019-2022', 'sage' ),
            'priority' => 10,
        ]
    );

new \Kirki\Section(
    'footer_logo',
    [
        'title'       => esc_html__( 'Logo', 'sage' ),
        'panel'       => 'footer',
        'priority'    => 20,
    ],
);

    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_logo_setting',
            'label'       => esc_html__( 'Image', 'sage' ),
            'section'     => 'footer_logo',
            'choices'     => [
                'save_as' => 'array',
            ],
        ]
    );

new \Kirki\Section(
    'footer_tagline',
    [
        'title'       => esc_html__( 'Tagline', 'sage' ),
        'panel'       => 'footer',
        'priority'    => 30,
    ],
);

    new \Kirki\Field\Text(
        [
            'settings'    => 'footer_taglineText_setting',
            'label'       => __( 'Tagline Text', 'sage' ),
            'section'     => 'footer_tagline',
            'default'  => esc_html__( 'Bootstrap 2019-2022', 'sage' ),
            'priority' => 10,
        ]
    );

new \Kirki\Section(
    'footer_social_media',
    [
        'title'       => esc_html__( 'Social Media', 'sage' ),
        'description' => esc_html__( 'You can add social media links by pressing the "Add Social Media"', 'sage' ),
        'panel'       => 'footer',
        'priority'    => 40,
    ],
);

    new \Kirki\Field\Repeater(
        [
            'settings' => 'footer_social_media_repeater',
            'label'    => esc_html__( 'Repeater Control', 'kirki' ),
            'section'  => 'footer_social_media',
            'priority' => 10,
            'default'  => '',
            'row_label'     => [
                'type'      => 'text',
                'value'     => esc_html__( 'Social Media', 'sage' ),
            ],
            'button_label'  => esc_html__('+ Add Social Media', 'sage' ),
            'fields' => [
                'footer_social_media_select' => [
                    'type'		=> 'select',
                    'default'   => 'fb',
                    'choices' 	=> [
                        'fb'		=> 'Facebook',
                        'twitter'	=> 'Twitter',
                        'linkedin'	=> 'LinkedIn',
                        'github' => 'GitHub',
                    ],
                ],
                'footer_social_media_link' => [
                    'type'		=> 'text',
                    'label'       => __( 'Link', 'sage' ),
                    'default'     => '',
                ],
            ],
            'choices' => [
                'limit' => 4,
            ],
        ]
    );