<?php
new \Kirki\Panel(
	'header',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Header', 'sage' ),
		'description' => esc_html__( 'customize header panels', 'sage' ),
	]
);

new \Kirki\Section(
    'header_resume',
    [
        'title'       => esc_html__( 'Resume', 'sage' ),
        'description' => esc_html__( 'Header Contact Details.', 'sage' ),
        'panel'       => 'header',
        'priority'    => 10,
    ],
);

    new \Kirki\Field\Text(
        [
            'settings'    => 'header_resumeText_field_setting',
            'label'       => __( 'Label of the button', 'sage' ),
            'section'     => 'header_resume',
            'default'     => '',
        ]
    );

    new \Kirki\Field\Upload(
        [
            'settings'    => 'header_resumeFile_setting',
            'label'       => esc_html__( 'Resume', 'kirki' ),
            'section'     => 'header_resume',
        ]
    );


