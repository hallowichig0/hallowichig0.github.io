<?php
new \Kirki\Panel(
	'sidebar_blog',
	[
		'priority'    => 20,
		'title'       => esc_html__( 'Sidebar for Blog', 'sage' ),
		'description' => esc_html__( 'customize sidebar panels', 'sage' ),
	]
);

new \Kirki\Section(
	'sidebar_blog_toggle',
	[
		'title'       => esc_html__( 'Enable or Disable Sidebar', 'sage' ),
		'description' => esc_html__( 'This feature can enable/disable the sidebar', 'sage' ),
		'panel'       => 'sidebar_blog',
		'priority'    => 10,
    ],
);

    new \Kirki\Field\Toggle(
        [
            'settings'    => 'sidebar_blog_toggleSwitch_setting',
            'label'       => __( 'Enable/Disable', 'sage' ),
            'section'     => 'sidebar_blog_toggle',
            'default'     => false,
            'priority'    => 10,
        ]
    );

/**
 * Sidebar Widgets
 */
include 'sidebar-widgets.php' ;