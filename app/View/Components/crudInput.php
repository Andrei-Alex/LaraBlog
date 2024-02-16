<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CrudInput extends Component
{
    /**
     * Create a new component instance.
     * @param string $type
     * @param string $name
     * @param string $value
     * @param string $label
     * @param string|null $class
     */
    public function __construct(
        public string      $type = 'text',
        public string|null $class = null,
        public string      $name = '',
        public string      $value = '',
        public string      $label = '')
    {
        $this->label === '' ? $this->label = ucfirst($this->name) : $this->label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.crud-input');
    }
}
