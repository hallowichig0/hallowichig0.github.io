<?php
new \Kirki\Section(
	'sidebar_blog_widgets',
	[
		'title'       => esc_html__( 'Widgets', 'sage' ),
		'description' => esc_html__( 'These widgets will not visible if the sidebar toggle was disabled.', 'sage' ),
		'panel'       => 'sidebar_blog',
		'priority'    => 20,
    ],
);

new \Kirki\Field\Repeater(
    [
        'settings' => 'sidebar_blog_widget_repeater',
        'label'    => esc_html__( 'Repeater Control', 'kirki' ),
        'section'  => 'sidebar_blog_widgets',
        'priority' => 10,
        'default'  => '',
        'row_label'     => [
            'type'      => 'text',
            'value'     => esc_html__( 'Widget', 'sage' ),
        ],
        'button_label'  => esc_html__('+ Add Widgets', 'sage' ),
        'fields' => [
            'sidebar_blog_select_widget' => [
                'type'		=> 'select',
                'choices' 	=> [
                    ''				=> 'Please select a widget',
                    'search'		=> 'Search',
                    'category'		=> 'Category',
                    'archive'       => 'Archive',
                ],
            ],
        ],
    ]
);