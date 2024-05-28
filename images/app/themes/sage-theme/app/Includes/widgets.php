<?php

register_sidebar( array(
    'name'          => esc_html__( 'Sidebar for blog', 'sage' ),
    'id'            => 'sidebar-blog',
    'description'   => esc_html__( 'Add widgets here.', 'sage' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
) );