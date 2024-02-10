<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrudButton extends Component
{
    public string $href;
    public string|null $text;
    public string|null $type;
    public string|null $rounded;
    public bool $disabled;
    public string|null $icon;

    private $roundedStyles = [
        'true' => 'rounded ',
        'left' => 'rounded-l',
        'right' => 'rounded-r',
        'none' => '',
    ];

    public function __construct($href, $text = null, $type = 'preview', $rounded = 'true', $disabled = false, $icon=null)
    {
        $this->href = $href;
        $this->text = $text;
        $this->type = $type;
        $this->rounded = $this->roundedStyles[$rounded] ?? $this->roundedStyles['true'];
        $this->disabled = $disabled;
        $this->icon = $icon;

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
            'preview' => 'bg-blue-500 hover:bg-blue-700 text-white',
            'edit' => 'bg-cyan-500 hover:bg-blue-700 text-white',
            'danger' => 'bg-red-500 hover:bg-blue-700 text-white',
            'warning' => 'bg-yellow-500 hover:bg-yellow-700 text-black',
            'info' => 'bg-cyan-500 hover:bg-cyan-700 text-white',
            'default' => 'bg-gray-500 hover:bg-gray-700 text-white',
        ];

        return $buttonStyles[$this->type] ?? $buttonStyles['preview'];
    }
}
