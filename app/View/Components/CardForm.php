<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardForm extends Component
{
    public $title, $url, $titleBtn;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$url, $titleBtn)
    {
        $this->title = $title;
        $this->url = $url;
        $this->titleBtn = $titleBtn;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-form');
    }
}
