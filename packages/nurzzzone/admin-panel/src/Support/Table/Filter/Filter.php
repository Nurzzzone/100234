<?php

namespace Nurzzzone\AdminPanel\Support\Table\Filter;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @className Filter
 * @package Nurzzzone\AdminPanel\Support\Table\Filter
 */
class Filter implements Arrayable
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $paramName;

    /**
     * @var array
     */
    protected $options = [];

    public function __construct(string $label, string $paramName, array $options = [])
    {
        $this->label = $label;
        $this->paramName = $paramName;
        $this->options = $options;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function addOption(string $name, $value): self
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'label'     => $this->label,
            'paramName' => $this->paramName,
            'type'      => $this->type,
            'options'   => $this->options
        ];
    }
}