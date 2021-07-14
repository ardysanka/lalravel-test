<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;
    public $type;
    public function __construct($message, $type)
    {
        $this->message = $message;
        switch ($type) {
            case 'notifSuccess':
                $this->type = 'success';
                break;
            case 'notifWarning':
                $this->type = 'warning';
                break;
            case 'notifError':
                $this->type = 'danger';
                break;
            default:
                $this->type = 'info';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification');
    }
}
