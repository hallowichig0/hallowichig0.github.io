<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Validation for dependency plugin
 *
 * @return void
 */
add_action('after_switch_theme', function ($oldtheme_name, $oldtheme) {
    /**
     * Kirki validation text
     */
    if ( !class_exists( 'Kirki' ) ) {
        add_filter( 'gettext', function($translated, $original, $domain) {
            $strings = array(
                'New theme activated.' => 'Theme not activated. Sage Theme has dependency with kirki plugin. You must activate <a target="_blank" href="https://wordpress.org/plugins/kirki/">kirki plugin</a> first before activating this theme.'
            );
        
            if ( isset( $strings[$original] ) ) {
                $translations = get_translations_for_domain( $domain );
                $translated = $translations->translate( $strings[$original] );
            }
        
            return $translated;
        }, 10, 3 );
        add_action( 'admin_head', __NAMESPACE__ . '\\error_activation_admin_notice' );
        switch_theme( $oldtheme->stylesheet );
        return false;
    }
    /**
     * ACF validation text
     */
    if ( !class_exists( 'ACF' ) ) {
        add_filter( 'gettext', function($translated, $original, $domain) {
            $strings = array(
                'New theme activated.' => 'Theme not activated. Sage Theme has dependency with ACF plugin. You must activate <a target="_blank" href="https://wordpress.org/plugins/advanced-custom-fields/">ACF plugin</a> first before activating this theme.'
            );
        
            if ( isset( $strings[$original] ) ) {
                $translations = get_translations_for_domain( $domain );
                $translated = $translations->translate( $strings[$original] );
            }
        
            return $translated;
        }, 10, 3 );
        add_action( 'admin_head', __NAMESPACE__ . '\\error_activation_admin_notice' );
        switch_theme( $oldtheme->stylesheet );
        return false;
    }
}, 10, 2);

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {

    if ( !is_admin() || !is_customize_preview() ) {
        // Dequeue Gutenberg Block CSS
        wp_dequeue_style( 'wp-block-library' );
	
        /*
        * Dequeue Gutenberg Block CSS
        * if you want to embed other people's WordPress posts into your own WordPress posts, comment `wp-embed`
        */
        wp_deregister_script( 'wp-embed' );
    }

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // buds styles & scripts
    bundle('app')->enqueue();
    
}, 100);

/**
 * Remove JQuery migrate
 * https://joewp.com/en/remove-jquery-migrate/
 */
add_action('wp_default_scripts', function ($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery']) || !is_customize_preview()) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
});

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Header Logo
    add_theme_support( 'custom-logo', array(
        'height'      => 63,
        'width'       => 63,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description'),
    ));

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * woocommerce theme setup
     */
    // add_theme_support('woocommerce');

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Disable the default block patterns.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Disable the Widgets Block Editor
     * @link https://developer.wordpress.org/block-editor/how-to-guides/widgets/opting-out
     */
    remove_theme_support( 'widgets-block-editor' );

    /*
    * All Custom thumbnails
    */
    add_image_size( 'banner-scale-1920-1080', 1920, 1080, true ); // scale
    add_image_size( 'banner-crop-1920-1080', 1920, 1080, array( 'center', 'center' ) ); // scale & crop
    add_image_size( 'medium-600-600', 600, 600, array( 'center', 'center' ) ); // scale & crop
    add_image_size( 'medium-413-413', 413, 413, array( 'center', 'center' ) ); // scale & crop
    add_image_size( 'thumbnail-70-70', 70, 70, array( 'center', 'center' ) );
    add_image_size( 'thumbnail-5-5', 5, 5, array( 'center', 'center' ) );

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary-menu' => __( 'Primary Menu', 'sage' ),
        'footer-menu' => __( 'Footer Menu', 'sage' ),
    ]);

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    require_once get_template_directory() . '/app/Includes/widgets.php';
});

/**
 * This is where you can register custom post types & custom taxonomies.
 *
 * @return void
 */
add_action('init', function () {
    require_once get_template_directory() . '/app/Includes/custom-post-type.php'; // custom post types
    require_once get_template_directory() . '/app/Includes/custom-taxonomy.php'; //custom taxonomies
});

/**
 * Default Favicon
 *
 * @return void
 */
add_action('wp_head', function () {
    if( ! has_site_icon()  && ! is_customize_preview() ) {
        echo '<link rel="shortcut icon" type="image/x-icon" href="'.asset('images/w-logo-blue.png')->uri().'" />';
    }
});

/**
 * pre_get_posts function added to include custom post type in author loop
 *
 * @return void
 */
add_action('pre_get_posts', function ($query) {
    if ( !is_admin() && $query->is_author() && $query->is_main_query() ) {
        $query->set( 'post_type', array('post', 'your-custom-post-type' ) );
    }
});

/**
 * Uncomment this if woocommerce was not templated
 *
 * @return void
 */
// add_action('pre_get_posts', function ($query) {
//     if ( class_exists( 'WooCommerce' ) ) {
//         if ( !is_admin() && $query->is_archive() && $query->is_main_query() && !is_post_type_archive( 'product' ) ) {
//             $query->set( 'post_type', array('post', 'your-custom-post-type' ) );
//         }
//     }else {
//         if ( !is_admin() && $query->is_archive() && $query->is_main_query() ) {
//             $query->set( 'post_type', array('post', 'your-custom-post-type' ) );
//         }
//     }
// });

/**
 * Uncomment this if woocommerce was templated
 * pre_get_posts function added to include custom post type in archive loop
 *
 * @return void
 */
// add_action('pre_get_posts', function ($query) {
//     if ( class_exists( 'WooCommerce' ) ) {
//         $prod_cat = '';
//         if(!empty($query->query_vars['product_cat'])){
//             $prod_cat = $query->query_vars['product_cat'];
//         }
//         if ( !is_admin() && $query->is_archive() && $query->is_main_query() && !is_shop() && !$prod_cat) {
//             $query->set( 'post_type', array('post', 'your-custom-post-type' ) );
//         }
//     }else {
//         if ( !is_admin() && $query->is_archive() && $query->is_main_query()) {
//             $query->set( 'post_type', array('post', 'your-custom-post-type' ) );
//         }
//     }
// });

// custom post type pagination
// function custom_posts_per_page( $query ) {

//     if ( $query->is_archive('your-custom-post-type') ) {
//         set_query_var('posts_per_page', -1);
//     }
// }
// add_action( 'pre_get_posts', __NAMESPACE__ . '\\custom_posts_per_page' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @return void
 */
add_action('wp_head', function () {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
});

/**
 * Add active class called (current-page-ancestor) on parent and grandparent menu while you are in a single post or page
 *
 * @return string
 */
function add_current_nav_class($classes, $item) {
    // Getting the current post details
    global $post;

    // Get post ID, if nothing found set to NULL
    $id = ( isset( $post->ID ) ? get_the_ID() : NULL );

    // Checking if post ID exist...
    if (isset( $id )){

        // Getting the post type of the current post
        $current_post_type = get_post_type_object(get_post_type($post->ID));

        // Getting the rewrite slug containing the post type's ancestors
        $ancestor_slug = $current_post_type->rewrite ? $current_post_type->rewrite['slug'] : '';

        // Split the slug into an array of ancestors and then slice off the direct parent.
        $ancestors = explode('/',$ancestor_slug);
        $parent = array_pop($ancestors);

        // Getting the URL of the menu item
        $menu_slug = strtolower(trim($item->url));

        // Remove domain from menu slug
        $menu_slug = str_replace($_SERVER['SERVER_NAME'], "", $menu_slug);

        // If the menu item URL contains the post type's parent
        if (!empty($menu_slug) && !empty($parent) && strpos($menu_slug,$parent) !== false) {
            $classes[] = 'current-menu-item';
        }

        // If the menu item URL contains any of the post type's ancestors
        foreach ( $ancestors as $ancestor ) {
            if (!empty($menu_slug) && !empty($ancestor) && strpos($menu_slug,$ancestor) !== false) {
                $classes[] = 'current-page-ancestor';
            }
        }
    }
    // Return the corrected set of classes to be added to the menu item
    return $classes;
}
add_action('nav_menu_css_class', __NAMESPACE__ . '\\add_current_nav_class', 10, 2 );

/**
 * Filter by Custom Taxonomy in WP Admin
 *
 * @return void
 */
// function filter_cars_by_taxonomies( $post_type, $which ) {

// 	// Apply this only on a specific post type
// 	if ( 'your-custom-post-type' !== $post_type )
// 		return;

// 	// A list of taxonomy slugs to filter by
// 	$taxonomies = array( 'your-custom-taxonomy' );

// 	foreach ( $taxonomies as $taxonomy_slug ) {

// 		// Retrieve taxonomy data
// 		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
// 		$taxonomy_name = $taxonomy_obj->labels->name;

// 		// Retrieve taxonomy terms
// 		$terms = get_terms( $taxonomy_slug );

// 		// Display filter HTML
// 		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
// 		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
// 		foreach ( $terms as $term ) {
// 			printf(
// 				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
// 				$term->slug,
// 				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
// 				$term->name,
// 				$term->count
// 			);
// 		}
// 		echo '</select>';
// 	}

// }
// add_action( 'restrict_manage_posts', __NAMESPACE__ . '\\filter_cars_by_taxonomies' , 10, 2);

/**
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 *
 * @return void
 */
add_action('admin_action_duplicate_post_as_draft', function () {
    global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}

	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;

	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {

		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => 'Duplicate ' . $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );

		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}

		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
});

/*
 * Add the duplicate link to action list for post_row_actions
 */
function duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts') && get_post_type() != 'page') {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', __NAMESPACE__ . '\\duplicate_post_link', 10, 2 );
add_filter('page_row_actions', __NAMESPACE__ . '\\duplicate_post_link', 10, 2);

/*
 * Automatically update permalink base on the page title
 */
function permalink_path_auto($postId, $after, $before) {
	if ($after->post_title != $before->post_title && empty($_POST['permalink_path_auto_disable'])) {
		$after->post_name = ''; // Reset permalink
		wp_update_post($after);
	}
}
add_action('post_updated', __NAMESPACE__ . '\\permalink_path_auto', 10, 3);

/*
 * Path Auto input checkbox whether enable or disable the automatic update permalink
 */
function permalink_path_auto_submitbox() {
	global $post;
	echo('
	<div style="margin-bottom: 8px;">
		<label>
			<input type="checkbox" name="permalink_path_auto_disable" />
			Disable automatic permalink update
		</label>
	</div>
	');
}
add_action('post_submitbox_start', __NAMESPACE__ . '\\permalink_path_auto_submitbox');

/**
 * Hide classic editor on specific editor posts, pages & custom post type
 *
 * @return void
 */
add_action( 'admin_head', function () {
    // remove classic editor in homepage
    if((int) get_option('page_on_front')==get_the_ID()){
        remove_post_type_support('page', 'editor');
    }
    // remove page editor globally
    // remove_post_type_support('page', 'editor');
    // remove post editor globally
    // remove_post_type_support('post', 'editor');
    // add this line for custom post types and replace custom-post-type-name with the name of post type:
    // remove_post_type_support('custom-post-type-name', 'editor');
});

/**
 * Hide classic editor if certain template is selected
 *
 * @return void
 */
// add_action('init', function() {
//     if (isset($_GET['post'])) {
//         $id = $_GET['post'];
//         $template = get_post_meta($id, '_wp_page_template', true);
//         switch ($template) {
//             case 'page-templates/your-template-name.blade.php':
//             // the below removes 'editor' support for 'pages'
//             remove_post_type_support('page', 'editor');
//             // if you want to remove for posts or custom post types as well add this line for posts:
//             // remove_post_type_support('post', 'editor');
//             // add this line for custom post types and replace custom-post-type-name with the name of post type:
//             // remove_post_type_support('custom-post-type-name', 'editor');
//             break;
//             default :
//             // Don't remove any other template.
//             break;
//         }
//     }
// });

/**
 * Show menu pages on specific roles
 *
 * @return void
 */
add_action('admin_head', function () {
    if( !current_user_can('administrator') ) {
        remove_menu_page('edit-comments.php'); // Comments
        remove_menu_page('wpcf7'); // Contact Form 7 Menu
    }
});

/**
 * Hide submenu on appearance menu
 *
 * @return void
 */
add_action('admin_head', function () {
    // check condition for the user means show menu for this user
    if( !current_user_can('administrator') ) {
        //We need this because the submenu's link (key from the array too) will always be generated with the current SERVER_URI in mind.
        $customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );
        $themes = 'themes.php';
        $widget = 'widgets.php';
        $menu = 'nav-menus.php';

        // remove_submenu_page( 'themes.php', $customizer_url ); // remove customize from appearance menu
        remove_submenu_page( 'themes.php', $themes ); // remove themes from appearance menu
        remove_submenu_page( 'themes.php', $widget ); // remove widgets from appearance menu
        remove_submenu_page( 'themes.php', $menu );// remove menus from appearance menu
    }
}, 999);

/**
 * Unset section in customizer panel.
 * Take Note: Only section is working. To unset the panel, please use customize_loaded_components hook instead.
 * You can use remove_panel for kirki panels only
 *
 * @return void
 */
add_action('customize_register', function ($wp_customize) {
    // check condition for the user means show menu for this user
    if( !current_user_can('administrator') ) {

        // Wordpress Core Section
        $wp_customize->remove_section( 'title_tagline');
        $wp_customize->remove_section( 'static_front_page');
        $wp_customize->remove_section( 'custom_css');

        // Kirki Panel
        $wp_customize->remove_panel( 'sidebar_blog');

        // Kirki Section
        $wp_customize->remove_section( 'header_Logo');
        $wp_customize->remove_section( 'header_background');
        $wp_customize->remove_section( 'footer_background');

        // Kirki Control
        // $wp_customize->remove_control( 'your_settings');
    }
}, 100);

/**
 * Removes the featured image metabox from specific post type
 */
function remove_feature_image() {
    remove_meta_box( 'postimagediv','page','side' ); // remove featured image from page
    // remove_meta_box( 'postimagediv','post','side' ); // remove featured image from post
    // remove_meta_box( 'postimagediv','your_custom_post_type','side' ); // remove featured image from custom post type
}
add_action('do_meta_boxes', __NAMESPACE__ . '\\remove_feature_image');

// Removes the Yoast Metabox for Roles other then Admins
function disable_seo_yoast_metabox() {
    remove_meta_box( 'wpseo_meta', 'post', 'normal' );
    remove_meta_box( 'wpseo_meta', 'page', 'normal' );
}

// Disable WordPress SEO meta box for all roles other than administrator and seo
function wpseo_yoast_init(){
    $user = wp_get_current_user();
    $allowed_roles = array('administrator', 'wpseo_manager', 'wpseo_editor');
    if( !array_intersect($allowed_roles, $user->roles) ) {
        // Remove page analysis columns from post lists, also SEO status on post editor
        add_filter( 'wpseo_use_page_analysis', '__return_false' );
        // Remove Yoast meta boxes
        add_action( 'add_meta_boxes', __NAMESPACE__ . '\\disable_seo_yoast_metabox', 100000 );
    }
}
add_action('init', __NAMESPACE__ . '\\wpseo_yoast_init');

/**
 * Disable Comments Menu
 *
 * @return void
 */
add_action('admin_init', function () {
    global $post_type;
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

/**
 * Disable items in Admin Bar
 *
 * @return void
 */
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('menus');
    $wp_admin_bar->remove_menu('widgets');
});

add_action( 'login_enqueue_scripts', function() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo asset('images/w-logo-blue.png')->uri(); ?>);
            background-size: 100% 80px;
            background-repeat: no-repeat;
            width: 100%;
            height: 80px;
            max-width: 80px;
        }
    </style>
<?php });
