<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalContentButton extends Component
{
    /**
     * @var string
     */
    public $for;

    /**
     * @var string
     */
    public $class;

    public function __construct(string $for, string $class = 'btn-default')
    {
        $this->for = $for;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.modal-content-button');
    }
}
