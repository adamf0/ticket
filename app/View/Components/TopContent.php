<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TopContent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title = '';
    public $subtitle = '';
    public $img = '';
    public $type = '';
    public function __construct($title = '', $subtitle = '', $img = '', $type='')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->img = $img;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top-content',[
            "title"=>$this->title,
            "subtitle"=>$this->subtitle,
            "img"=>$this->img,
            "type"=>$this->type
        ]);
    }
}
