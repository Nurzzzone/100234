<?php

namespace Nurzzzone\AdminPanel\Support\Table\Column;

/**
 * @className Toggle
 * @package Nurzzzone\AdminPanel\Support\Table\Column
 */
class Toggle
{
    /**
     * @var string
     */
    protected $type = 'toggle';

    /**
     * @var bool
     */
    protected $sync = false;

    public function enableSync(): self
    {
        $this->sync = true;

        return $this;
    }
}
