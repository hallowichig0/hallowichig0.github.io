<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    public $types = [
        'primary' => 'alert alert-primary',
        'secondary' => 'alert alert-secondary',
        'success' => 'alert alert-success',
        'danger' => 'alert alert-danger',
        'warning' => 'alert alert-warning',
        'info' => 'alert alert-info',
        'light' => 'alert alert-light',
        'dark' => 'alert alert-dark',
    ];

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type = 'primary', $message = null)
    {
        $this->type = $this->types[$type] ?? $this->types['primary'];
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.alert');
    }
}