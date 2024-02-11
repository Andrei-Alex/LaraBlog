<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Component responsible for displaying session messages.
 *
 * This component fetches and displays messages that have been stored in the session.
 * It is capable of handling different types of messages such as success, error, info, etc.,
 * by utilizing the `message` and `messageType` session variables.
 */
class SessionMessage extends Component
{
    /**
     * The message content fetched from the session.
     *
     * @var string|null
     */
    public ?string $message = null;

    /**
     * The type of message, which determines styling, fetched from the session.
     * Defaults to 'info' if not specified in the session.
     *
     * @var string|null
     */
    public ?string $type = null;

    /**
     * Create a new SessionMessage component instance.
     *
     * Initializes the component by fetching the message and its type from the session.
     */
    public function __construct()
    {
        $messageTypes = ['success', 'error', 'info', 'warning'];

        foreach ($messageTypes as $type) {
            if (session()->has($type)) {
                $this->message = session($type);
                $this->type = $type;
                break; // Stop once a message is found.
            }
        }
        if (is_null($this->message)) {
            $this->message = session('message');
            $this->type = session('messageType', 'info');
        }
    }


    /**
     * Get the view that represents the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\Foundation\Application|\Closure|string
     */
    public function render()
    {
        return view('components.session-message');
    }
}
