<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * A Blade component for rendering session messages in a consistent format.
 *
 * Utilizes Laravel's session store to check for messages of various types (success, error, info, warning)
 * and displays them if available. This component streamlines the display of feedback messages
 * to the user across different views.
 */
class SessionMessage extends Component
{
    /**
     * Content of the message fetched from the session.
     *
     * @var string|null
     */
    public ?string $message = null;

    /**
     * Type of the message which determines its styling.
     * Defaults to 'info' if a specific type is not provided in the session.
     *
     * @var string|null
     */
    public ?string $type = null;

    /**
     * Constructs a new instance of the SessionMessage component.
     *
     * Checks the session for messages of various types and initializes the component
     * state with the first message found. Supports custom message types beyond the basic
     * success, error, info, and warning types by fetching 'message' and 'messageType' from the session.
     */
    public function __construct()
    {
        $messageTypes = ['success', 'error', 'info', 'warning'];

        foreach ($messageTypes as $type) {
            if (session()->has($type)) {
                $this->message = session($type);
                $this->type = $type;
                break;
            }
        }

        if (is_null($this->message)) {
            $this->message = session('message');
            $this->type = session('messageType', 'info');
        }
    }

    /**
     * Get the view or string content that represents the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string
     */
    public function render()
    {
        return view('components.session-message');
    }
}
