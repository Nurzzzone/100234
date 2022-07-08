<?php

namespace Nurzzzone\AdminPanel\Support\Table\Column;

/**
 * @className Link
 * @package Nurzzzone\AdminPanel\Support\Table\Column
 */
class Link extends Column
{
    /**
     * @var string
     */
    protected $type = 'link';

    /**
     * @var string
     */
    protected $url;

    public function setUrl(string $value): self
    {
        $this->url = $value;

        return $this;
    }
}