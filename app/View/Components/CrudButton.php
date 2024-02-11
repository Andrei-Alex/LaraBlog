<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * A Blade component for rendering buttons with various styles and functionalities.
 *
 * This component simplifies the creation of buttons throughout the application,
 * supporting customization for href, text, type, rounded corners, disabled state, and icon.
 */
class CrudButton extends Component
{
    /**
     * The URL the button links to.
     */
    public string $href;

    /**
     * The text to display on the button.
     */
    public string|null $text;

    /**
     * The type of button, which determines its styling.
     */
    public string|null $type;

    /**
     * The class to apply for rounded corners.
     */
    public string|null $rounded;

    /**
     * Indicates whether the button is disabled.
     */
    public bool $disabled;

    /**
     * The icon class to display on the button.
     */
    public string|null $icon;

    /**
     * Mapping of rounded styles to their corresponding Tailwind CSS classes.
     */
    private array $roundedStyles = [
        'true' => 'rounded',
        'left' => 'rounded-l',
        'right' => 'rounded-r',
        'none' => '',
    ];

    /**
     * Create a new component instance.
     *
     * @param string $href The URL the button links to.
     * @param string|null $text The text to display on the button.
     * @param string $type The button's type which determines its styling.
     * @param string $rounded The rounded style to apply.
     * @param bool $disabled Indicates if the button is disabled.
     * @param string|null $icon The icon class to use.
     */
    public function __construct(
        string $href,
        string|null $text = null,
        string $type = 'preview',
        string $rounded = 'true',
        bool $disabled = false,
        string|null $icon = null
    ) {
        $this->href = $href;
        $this->text = $text;
        $this->type = $type;
        $this->rounded = $this->roundedStyles[$rounded] ?? $this->roundedStyles['true'];
        $this->disabled = $disabled;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.crud-button', [
            'buttonClass' => $this->getButtonClass(),
            'roundedClass' => $this->rounded,
            'disabled' => $this->disabled,
            'icon' => $this->icon,
        ]);
    }

    /**
     * Determines the button's class based on its type.
     *
     * @return string The Tailwind CSS classes for the button.
     */
    private function getButtonClass(): string
    {
        $buttonStyles = [
            'preview' => 'bg-blue-500 hover:bg-blue-700 text-white',
            'edit' => 'bg-cyan-500 hover:bg-blue-700 text-white',
            'danger' => 'bg-red-500 hover:bg-red-700 text-white',
            'warning' => 'bg-yellow-500 hover:bg-yellow-700 text-black',
            'info' => 'bg-cyan-500 hover:bg-cyan-700 text-white',
            'default' => 'bg-gray-500 hover:bg-gray-700 text-white',
        ];

        return $buttonStyles[$this->type] ?? $buttonStyles['preview'];
    }
}
