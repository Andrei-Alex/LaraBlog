<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrudButton extends Component
{
    public $href;
    public $text;
    public $type;
    public $rounded;
    private $roundedStyles = [
        'true' => 'rounded',
        'left' => 'rounded-l',
        'right' => 'rounded-r',
        'none' => '',
    ];

    public function __construct($href, $text, $type = 'primary', $rounded = 'true')
    {


        $this->href = $href;
        $this->text = $text;
        $this->type = $type;
        $this->rounded = $this->roundedStyles[$rounded] ?? $this->roundedStyles['true'];
    }

    public function render()
    {
        return view('components.crud-button', [
            'buttonClass' => $this->getButtonClass(),
            'roundedClass' => $this->rounded,
        ]);
    }

    private function getButtonClass()
    {
        $buttonStyles = [
            'primary' => 'bg-blue-500 hover:bg-blue-700 text-white',
            'edit' => 'bg-cyan-500 hover:bg-cyan-700 text-white',
            'danger' => 'bg-red-500 hover:bg-red-700 text-white',
            'warning' => 'bg-yellow-500 hover:bg-yellow-700 text-black',
            'info' => 'bg-cyan-500 hover:bg-cyan-700 text-white',
        ];

        return $buttonStyles[$this->type] ?? $buttonStyles['primary'];
    }
}
