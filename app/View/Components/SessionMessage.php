<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SessionMessage extends Component
{
    public $message;
    public $type;

    public function __construct()
    {
        $this->message = session('message');
        $this->type = session('messageType', 'info');
    }

    public function render()
    {
        return view('components.session-message');
    }
}
