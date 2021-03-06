<?php

namespace App\View\Components\Bucketlist;

use Illuminate\View\Component;

class Nav extends Component
{
    // And array of which bucketlist menu options to show
    public $show;

    // If Nav is showing up on an item page the item is passed
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($show = 'list', $item = null)
    {
        $this->show = explode('|', $show);
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bucketlist.nav');
    }
}
