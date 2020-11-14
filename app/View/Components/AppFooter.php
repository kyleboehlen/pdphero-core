<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppFooter extends Component
{
    public $highlight;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.app-footer');
    }
}
