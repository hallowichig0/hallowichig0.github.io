<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'header_logo' => $this->siteLogo(),
            'primary_menu' => $this->primaryMenu(),
        ];
    }

    public function siteLogo()
    {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $header_logo_src = wp_get_attachment_image_url( $custom_logo_id , 'full' );
        $header_logo_srcset = wp_get_attachment_image_srcset( $custom_logo_id , 'full' );
        $header_logo_sizes = wp_get_attachment_image_sizes( $custom_logo_id , 'full' );
        
        return '<img width="100" height="40" src="'.$header_logo_src.'" srcset="'.$header_logo_srcset.'" sizes="'.$header_logo_sizes.'" alt="'.get_bloginfo( 'name' ).'" />';
    }

    /**
     * Primary Nav Menu arguments
     * @return array
     */
    public function primaryMenu() {
        $args = array(
            'theme_location'     => 'primary-menu',
            'depth'             => 2, // 1 = no dropdowns, greater than 2 = with dropdowns.
            'container'         => 'div',
            'container_class'   => 'navbar-collapse collapse',
            'container_id'      => 'navbarToggler',
            'menu_class'        => 'nav navbar-nav mx-auto mt-3 mt-md-0',
            'add_li_class'      => '', // set classes in li tag
            'add_a_class'       => 'nav-link px-md-4 mx-2 ml-md-0', // set classes in a tag
            'walker'            => new \App\wp_bootstrap5_navwalker(),
        );
        return $args;
    }
}