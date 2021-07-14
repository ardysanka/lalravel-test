<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $readonly;
    public $name;
    public $placeholder;
    public $type;
    public $id;
    public $value;

    public function __construct($name, $id, $type = "text", $placeholder = "", $value = "", $readonly = false)
    {
        $this->readonly = $readonly;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
