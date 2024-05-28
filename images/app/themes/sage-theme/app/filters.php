<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Define the image quality for JPEG manipulations. Ranges from 0 to 100. 
 * Higher values mean better image quality but bigger files.
 *
 * @return string
 */
add_filter('jpeg_quality', function ($arg) {
    return 90;
});

/**
 * Close comments on the front-end
 */
// add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter( 'wpcf7_autop_or_not', '__return_false' ); // remove <p> & <br> in contact form 7

/**
 * Remove automatically generated <p> & </br> tag in comment
 */
remove_filter('comment_text','wpautop',30);

/**
 * Excerpt Filters
 */
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Filter the except length to 20 words.
 *
 * @return string
 */
add_filter('excerpt_length', function ($length) {
    return 30;
}, 999);

/**
 * Filter the excerpt "read more" string.
 *
 * @return string
 */
add_filter('excerpt_more', function ($more) {
    return '...';
});

/**
 * Filter for Next & Prev post link button
 *
 * @return string
 */
function posts_link_attributes() {
    return 'class="page-link"';
}
add_filter('next_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');
add_filter('previous_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');

/**
 * Filter to add class in <li> tag in wp_nav_menu()
 *
 * @return string
 */
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}, 1, 3);

/**
 * Filter to add class in <li> tag in wp_nav_menu()
 *
 * @return string
 */
add_filter('nav_menu_link_attributes', function ($classes, $item, $args) {
    if($args->add_a_class) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}, 10, 3);

/**
 * @summary        filters an enqueued style tag and adds a noscript element after it
 * 
 * @description    filters an enqueued style tag (identified by the $handle variable) and
 *                 adds a noscript element after it.
 * 
 * @access    public
 * @param     string    $tag       The tag string sent by `style_loader_tag` filter on WP_Styles::do_item
 * @param     string    $handle    The script handle as sent by `script_loader_tag` filter on WP_Styles::do_item
 * @param     string    $href      The style tag href parameter as sent by `script_loader_tag` filter on WP_Styles::do_item
 * @param     string    $media     The style tag media parameter as sent by `script_loader_tag` filter on WP_Styles::do_item
 * @return    string    $tag       The filter $tag variable with the noscript element
 *
 * @return string
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    // as this filter will run for every enqueued script
    // we need to check if the handle is equals the script
    // we want to filter. If yes, than adds the noscript element
    if ( 'script-handle' === $handle ){
        $noscript = '<noscript>';
        // you could get the inner content from other function
        $noscript .= '<h1>You need to have JavaScript enabled to view this site.</h1>';
        $noscript .= '</noscript>';
        $tag = $tag . $noscript;
    }
    return $tag;
}, 10, 3);

/**
 * Add async on enqueue script
 *
 * @return string
 */
add_filter('clean_url', function ($url) {
    if ( strpos( $url, '#asyncscript') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncscript', '', $url );
    else
	return str_replace( '#asyncscript', '', $url )."' async='async";
}, 11, 1);

/**
 * Change load of style to preload
 *
 * @return string
 */
add_filter('clean_url', function ($url) {
    if ( strpos( $url, '#asyncstyle') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncstyle', '', $url );
    else
	return str_replace( '#asyncstyle', '', $url )."' onload='this.media=\"all\""; 
}, 11, 1);

/**
 * Filter Body Class
 *
 * @return string
 */
add_filter('body_class', function ($classes) {
    $classes[] = ''; // add class here
    return $classes;
});

/**
 * Update and replace featured image value with acf image field value
 * acf/update_value/name={$field_name} - filter for a specific field based on it's name
 *
 * @return string
 */
add_filter('acf/update_value/name=post_thumbnail_field', function ($value, $post_id, $field) {
    if($value != ''){
        // If post_thumbnail exists
        delete_post_thumbnail( $post_id);
        // Add the value which is the image ID to the _thumbnail_id meta data for the current post
        add_post_meta($post_id, '_thumbnail_id', $value);
    }
    return $value;
}, 10, 3);


function acfYearPicker($field) {
    $currentYear = date('Y');
    
    // Create choices array
    $field['choices'] = array();
    // Add blank first selection; remove if unnecessary
    $field['choices'][''] = '';
    // $field['choices'][$currentYear] = $currentYear;

    // Loop through a range of years and add to field 'choices'. Change range as needed.
    foreach(range($currentYear-30, $currentYear) as $value) {
            
        $field['choices'][$value] = $value;
            
    }

    // Return the field
    return $field;
}
add_filter('acf/load_field/name=frontpage_section4_experiences_subfield1', __NAMESPACE__ . '\\acfYearPicker');
add_filter('acf/load_field/name=frontpage_section4_experiences_subfield2', __NAMESPACE__ . '\\acfYearPicker');

/**
 * Disable Emoji Filters
 *
 * @return string
 */
add_filter('init', function () {
    // Prevent Emoji from loading on the front-end
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Remove from admin area also
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Remove from RSS feeds also
	remove_filter( 'the_content_feed', 'wp_staticize_emoji');
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji');

	// Remove from Embeds
	remove_filter( 'embed_head', 'print_emoji_detection_script' );

	// Remove from emails
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Disable from TinyMCE editor. Currently disabled in block editor by default
	add_filter( 'tiny_mce_plugins', function($plugins){
        if( is_array($plugins) ) {
            $plugins = array_diff( $plugins, array( 'wpemoji' ) );
        }
        return $plugins;
    } );

	/** Finally, prevent character conversion too
         ** without this, emojis still work 
         ** if it is available on the user's device
	 */

	add_filter( 'option_use_smilies', '__return_false' );
});

/**
 * Move Yoast Meta Box to bottom
 *
 * @return string
 */
add_filter( 'wpseo_metabox_prio', function() {
    return 'low';
});

/**
 * Removes "Add Media" buttons from post types.
 *
 * @return string
 */
// add_filter('wp_editor_settings', function ($settings) {
//     $current_screen = get_current_screen();

//     // Post types for which the media buttons should be removed.
//     $post_types = array( 'post', 'page' );

//     // Bail out if media buttons should not be removed for the current post type.
//     if ( ! $current_screen || ! in_array( $current_screen->post_type, $post_types, true ) ) {
//         return $settings;
//     }

//     $settings['media_buttons'] = false;

//     return $settings;
// });

/**
 * Disable Quick Edit
 */
function disable_quick_edit( $actions = array(), $post = null ) {
    if( !current_user_can('administrator') ) {
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            unset( $actions['inline hide-if-no-js'] );
        }
    }
    return $actions;
}
add_filter( 'post_row_actions', __NAMESPACE__ . '\\disable_quick_edit', 10, 2 );
add_filter( 'page_row_actions', __NAMESPACE__ . '\\disable_quick_edit', 10, 2 );

/**
 * Add defer attribute to Google reCaptcha script (Contact Form 7 Recaptcha v2)
 *
 * @param String $tag		- Script HTML
 * @param String $handle	- Unique identifier for script
 *
 * @return String $tag
 *
 * @return string
 */
// add_filter('script_loader_tag', function ($tag, $handle) {
//     // The handle for our google recaptcha script is <code>google-recaptcha</code>
// 	// IF it's not this handle return early
// 	if( 'google-recaptcha' !== $handle ) {
// 		return $tag;
// 	}
	
// 	// IF we don't already have a defer attribute, add it
// 	if( false === strpos( $tag, 'defer ' ) && false === strpos( $tag, ' defer' ) ) {
// 		$tag = str_replace( 'src=', 'defer src=', $tag );
// 	}
	
// 	return $tag;
// }, 10, 2);

/**
 * Add taxonomy permalink to our-products post type permalink
 * Example: mywebsite.local/our-products/category-sample/node
 * @return string
 */
// function our_products_permalinks( $post_link, $post ){
//     if ( is_object( $post ) && $post->post_type == 'our-products' ){
//         $terms = wp_get_object_terms( $post->ID, 'products_category' );
//         if( $terms ){
//             return str_replace( '%products_category%' , $terms[0]->slug , $post_link );
//         }
//     }
//     return $post_link;
// }
// add_filter( 'post_type_link', __NAMESPACE__ . '\\our_products_permalinks', 1, 2 );

add_filter( 'login_headerurl', function () {
    return home_url();
});

add_filter( 'login_headertext', function () {
    return get_bloginfo('name', 'display');
});

// Stop WordPress from overwriting .htaccess permalink rules
add_filter('flush_rewrite_rules_hard','__return_false');

// Change all image url from http://website.com/image to /image
add_filter('wp_get_attachment_url', function($url) {
    // $url = wp_make_link_relative($url);
    $url = str_replace(get_home_url(), '', $url); // Change from absolute to relative url
    return $url;
});

function relative_image_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    if(!is_admin()) {
        $images = [];

        foreach($sources as $source) {
            // $src = str_replace(get_home_url(), 'https://hallowichig0.github.io', $source['url']);
            $src = str_replace(get_home_url(), '', $source['url']); // Change from absolute to relative url
            $images[] = [
                'url' => $src,
                'descriptor' => $source['descriptor'],
                'value' => $source['value']
            ];
        }

        return $images;
    }

  return $sources;
}
add_filter('wp_calculate_image_srcset', __NAMESPACE__ . '\\relative_image_srcset', 10, 5);

/**
 * Filters the [canonical, opengraph] URL.
 *
 * @param string $canonical The current page's generated canonical URL.
 *
 * @return string The filtered canonical URL.
 */
function prefix_filter_yoast_rest_api_url( $data ) {
    // if ( is_page( 12345 ) ) {
      $data = str_replace(get_home_url(), 'https://hallowichig0.github.io', $data);
    // }
    return $data;
}
add_filter( 'wpseo_canonical', __NAMESPACE__ . '\\prefix_filter_yoast_rest_api_url' );
add_filter( 'wpseo_opengraph_url', __NAMESPACE__ . '\\prefix_filter_yoast_rest_api_url' );

/**
 * Replaces site_url in all schema graph.  
 *
 * @param array             $data    Schema.org graph.
 * @param Meta_Tags_Context $context Context object.
 *
 * @return array The altered Schema.org graph.
 */
function change_schema_urls( $data, $context ) {
    foreach ( $data as $key => $value ) {
        if ( $value['@type'] === 'Article' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            $data[$key]['isPartOf']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['isPartOf']['@id'] );
            $data[$key]['author']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['author']['@id'] );
            $data[$key]['mainEntityOfPage']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['mainEntityOfPage']['@id'] );
            $data[$key]['publisher']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['publisher']['@id'] );
            foreach($data[$key]['potentialAction'] as $key2 => $value2) {
                if ( $value2['@type'] === 'CommentAction' ) {
                    $data[$key]['potentialAction'][$key2]['target'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value2['target'] );
                }
            }
        }
        if ( $value['@type'] === 'WebPage' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            $data[$key]['url'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['url'] );
            $data[$key]['isPartOf']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['isPartOf']['@id'] );
            $data[$key]['breadcrumb']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['breadcrumb']['@id'] );
            foreach($data[$key]['potentialAction'] as $key2 => $value2) {
                if ( $value2['@type'] === 'ReadAction' ) {
                    $data[$key]['potentialAction'][$key2]['target'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value2['target'] );
                }
            }
        }
        if ( $value['@type'] === 'BreadcrumbList' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            foreach($data[$key]['itemListElement'] as $key2 => $value2) {
                if ( $value2['@type'] === 'ListItem' ) {
                    if(!empty($value2['item'])) {
                        $data[$key]['itemListElement'][$key2]['item'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value2['item'] );
                    }
                }
            }
        }
        if ( $value['@type'] === 'WebSite' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            $data[$key]['url'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['url'] );
            $data[$key]['publisher']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['publisher']['@id'] );
            $data[$key]['potentialAction'][0]['target']['urlTemplate'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['potentialAction'][0]['target']['urlTemplate'] );
        }
        if ( $value['@type'] === 'Organization' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            $data[$key]['url'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['url'] );
            $data[$key]['image'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['image'] );
            $data[$key]['logo']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['logo']['@id'] );
        }
        if ( $value['@type'] === 'Person' ) {
            $data[$key]['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['@id'] );
            $data[$key]['image']['@id'] = str_replace( get_home_url(), 'https://hallowichig0.github.io', $value['image']['@id'] );
        }
    }
    return $data;
}
add_filter( 'wpseo_schema_graph', __NAMESPACE__ . '\\change_schema_urls', 10, 2 );