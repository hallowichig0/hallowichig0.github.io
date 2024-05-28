<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Sidebar extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.sidebar',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'widgets' => get_theme_mod('sidebar_blog_widget_repeater'),
        ];
    }
}