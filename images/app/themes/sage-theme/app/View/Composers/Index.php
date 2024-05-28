<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Index extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'index',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'title' => $this->title(),
            'switch_sidebar' => get_theme_mod('sidebar_blog_toggleSwitch_setting'),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        if (is_home()) {
            return get_the_title(get_option('page_for_posts', true));
        }elseif (is_archive()) {
            return get_the_archive_title();
        }else {
            return get_the_title();
        }
    }
}