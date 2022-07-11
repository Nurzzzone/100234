<?php

namespace Nurzzzone\AdminPanel\View\Components;

use Illuminate\View\Component;

class ModalContent extends Component
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $class;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $action, $method = 'POST', $class = '', $options = [])
    {
        $this->id = $id;
        $this->action = $action;
        $this->method = $method;
        $this->class = $class;
        $this->options = $options;
    }

    public function render()
    {
        return view('components.modal-content');
    }
}
