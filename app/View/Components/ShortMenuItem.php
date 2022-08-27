<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShortMenuItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title = '';
    public $img = '';
    public $link = '#';
    public $color = 'red';

    public function __construct($title='',$img='',$link='#',$color='red')
    {
        $this->title = $title;
        $this->img = $img;
        $this->link = $link;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.short-menu-item',["title"=>$this->title,"img"=>$this->img,"link"=>$this->link,"color"=>$this->color]);
    }
}
