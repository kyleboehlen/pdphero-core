<?php

namespace App\View\Components\Goals;

use Illuminate\View\Component;

// Constants
use App\Helpers\Constants\Goal\Status;

class Goal extends Component
{
    // For extra styling classes
    public $class;

    // Holds the goal being rendered
    public $goal;

    // For holding goal status constants
    public $status;

    // Scope that is being viewed
    public $scope;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($goal, $class = null)
    {
        $this->class = $class;
        $this->goal = $goal;
        $this->status = Status::class;
        $this->scope = $goal->getScope();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        // To-do: don't render bucket list goal if setting is turned off
        return view('components.goals.goal');
    }
}
