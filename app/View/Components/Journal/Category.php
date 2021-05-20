<?php

namespace App\View\Components\Journal;

use Illuminate\View\Component;

class Category extends Component
{
    // Holds category object
    public $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category = null)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.journal.category');
    }
}
