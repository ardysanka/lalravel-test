<?php

namespace App\View\Components\alert;

use App\Models\Order;
use Illuminate\View\Component;

class StatusOrder extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $order;

    public function __construct($order)
    {
        $data = Order::find($order);
        $this->order = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert.status-order');
    }
}
