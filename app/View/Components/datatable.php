<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datatable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;

    public $columns;

    public $target;

    public $orientation;

    public $pageSize;

//    public $scroll;

    public function __construct($title, $columns, $target, $orientation, $pageSize)
    {
        $this->title = $title;
        $this->columns = $columns;
        $this->target = $target;
        $this->orientation = $orientation;
        $this->pageSize = $pageSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable');
    }
}
