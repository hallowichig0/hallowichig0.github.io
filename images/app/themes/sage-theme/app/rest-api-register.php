<?php
/**
 * All custom register rest api endpoint here
 */

namespace App;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;
use Yoast\WP\SEO\Surfaces\Meta_Surface;

add_action( 'rest_api_init', function() {
    register_rest_route( 'custom/v1', '/menu', // route: /wp-json/custom/v1/menu
        [
            'methods' => 'GET',
            'callback' => __NAMESPACE__ . '\\rest_api_endpoint_menu_route',
            'permission_callback'  => '__return_true', // comment or remove this if you will not use swagger api
        ]
    );
    register_rest_route( 'custom/v1', '/menu/(?P<id>\d+)', // route: /wp-json/custom/v1/menu/{id}
        [
            'methods' => 'GET',
            'callback' => __NAMESPACE__ . '\\rest_api_endpoint_menu_single',
            'permission_callback'  => '__return_true', // comment or remove this if you will not use swagger api
        ]
    );
    register_rest_route( 'custom/v1', '/global', // route: /wp-json/custom/v1/global
        [
            'methods' => 'GET',
            'callback' => __NAMESPACE__ . '\\rest_api_endpoint_global',
            'permission_callback'  => '__return_true', // comment or remove this if you will not use swagger api
        ]
    );
    register_rest_route( 'custom/v1', '/frontpage', // route: /wp-json/custom/v1/frontpage
        [
            'methods'   => 'GET',
            'callback'  => __NAMESPACE__ . '\\rest_api_endpoint_frontpage',
            'permission_callback'  => '__return_true', // comment or remove this if you will not use swagger api
        ] 
    );
});

function rest_api_endpoint_menu_route() {
    $menuLocations = get_nav_menu_locations(); // Get nav locations set in theme, usually setup.php)

    return new WP_REST_Response( $menuLocations, 200 );
}

function rest_api_endpoint_menu_single( WP_REST_Request $request ) {
    $menuID = $request->get_param('id'); // Get the menu from the ID
    $primaryNav = wp_get_nav_menu_items($menuID); // Get the array of wp objects, the nav items for our queried location.

    // Handle if error.
    if ( $primaryNav == false ) {
        // return error
        return new WP_Error( '404', esc_html__( 'Menu not found', 'sage' ), array( 'status' => 404 ) );
    }
    
    return new WP_REST_Response( $primaryNav, 200 );
}

function rest_api_endpoint_global( WP_REST_Request $request ) {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $site_logo_src = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    $site_logo_srcset = wp_get_attachment_image_srcset( $custom_logo_id , 'full' );
    $site_logo_sizes = wp_get_attachment_image_sizes( $custom_logo_id , 'full' );

    $site_logo = [
        'site_logo_src' => $site_logo_src,
        'site_logo_srcset' => $site_logo_srcset,
        'site_logo_sizes' => $site_logo_sizes,
        'site_logo_alt' => get_bloginfo( 'name' ),
    ];

    $data = [];

    // Site Identity
    $data['site_name'] = get_bloginfo('name', 'display');
    $data['site_logo'] = $site_logo;
    $data['site_tagline'] = get_bloginfo('description');
    $data['site_favicon'] = (!empty(get_site_icon_url())) ? get_site_icon_url() : asset('images/w-logo-blue.png')->uri();

    // Kirki Header
    $data['header_resume_label'] = get_theme_mod('header_resumeText_field_setting');
    $data['header_resume_file'] = get_theme_mod('header_resumeFile_setting');

    // Kirki Footer
    $data['footer_copyright'] = get_theme_mod('footer_copyrightText_setting');
    $data['footer_logo'] = get_theme_mod('footer_copyrightText_setting');
    $data['footer_tagline'] = get_theme_mod('footer_copyrightText_setting');
    $data['footer_social_media'] = get_theme_mod('footer_social_media_repeater');

    // Handle if error.
    if ( !$data ) {
        // return error
        return new WP_Error( '404', esc_html__( 'Global not found', 'sage' ), array( 'status' => 404 ) );
    }
    
    return new WP_REST_Response( $data, 200 );
}

function rest_api_endpoint_frontpage( WP_REST_Request $request ) {
    // Get WP options front page from settings > reading.
    $frontpage_id = get_option('page_on_front');
    $post = get_page($frontpage_id);

    // Handle if error.
    if ( empty( $frontpage_id ) ) {
        // return error
        return new WP_Error( '404', esc_html__( 'Static Frontpage not found', 'sage' ), array( 'status' => 404 ) );
    }

    $data = $post;
    // additional data
    $data->acf = get_fields($frontpage_id);
    // $data->acf['frontpage_section1_profileIcon_field']['title'] = 'Jayson Garcia'; // modify existing param called title
    // $data->acf['frontpage_section1_profileIcon_field']['additional_param'] = 'hello world'; // add additional param in data
    $data->template = get_post_meta($frontpage_id, '_wp_page_template', true);
    if (function_exists('YoastSEO')) {
        $meta_helper = YoastSEO()->classes->get(Meta_Surface::class);
        $meta = $meta_helper->for_post($frontpage_id);
        $data->yoast_head = $meta->get_head();
    }

    return new WP_REST_Response( $data, 200 );
}