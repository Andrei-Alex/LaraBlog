<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * A Blade component for rendering tags in the application.
 *
 * This component is designed to encapsulate the presentation logic of tags,
 * such as those used for categorizing or labeling content. It allows for
 * additional CSS classes to be passed for further customization, making it
 * versatile for various design requirements.
 */
class Tag extends Component
{
    /**
     * Additional CSS classes to be applied to the tag.
     *
     * This property enables the customization of the tag's appearance beyond
     * the default styling. It can be used to apply spacing, color, size, and
     * other CSS utilities.
     *
     * @var string
     */
    public $additionalClasses;

    /**
     * Create a new tag component instance.
     *
     * Initializes the component with optional additional CSS classes for styling.
     * This flexibility allows the tag to be easily adapted to different contexts
     * and visual requirements.
     *
     * @param string $additionalClasses Additional CSS classes for the tag.
     */
    public function __construct($additionalClasses = '')
    {
        $this->additionalClasses = $additionalClasses;
    }

    /**
     * Get the view or string content that represents the component.
     *
     * Specifies the Blade view that should be rendered as this component. The view
     * will have access to the component's public properties, including any additional
     * CSS classes passed during initialization.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('components.tag');
    }
}
