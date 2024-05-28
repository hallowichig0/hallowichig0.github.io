<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class WidgetCategory extends Component
{
    /**
     * The search title.
     *
     * @var string
     */
    public $title;

    public $category;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->category = $this->getWidgetCategory();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.widget-category');
    }

    /**
     * Get the categories
     *
     * @return string
     */
    public function getWidgetCategory() {
        $html = '';
        $categories = get_categories();
        foreach ($categories as $cat){
            $category_link = get_category_link($cat->cat_ID);
            $html .= '<div class="col-lg-6">';
            $html .= '<a href="'.esc_url( $category_link ).'" title="'.esc_attr($cat->name).'"> '.$cat->name.'</a>';
            $html .= '</div>';
        }

        return $html;
    }
}