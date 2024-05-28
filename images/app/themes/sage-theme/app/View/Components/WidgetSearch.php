<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class WidgetSearch extends Component
{
    /**
     * The search title.
     *
     * @var string
     */
    public $title;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.widget-search');
    }
}