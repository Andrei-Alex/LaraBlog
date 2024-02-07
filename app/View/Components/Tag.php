<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    public $additionalClasses;

    /**
     * Create a new component instance.
     *
     * @param  string  $additionalClasses
     * @return void
     */
    public function __construct($additionalClasses = '')
    {
        $this->additionalClasses = $additionalClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('components.tag');
    }
}
