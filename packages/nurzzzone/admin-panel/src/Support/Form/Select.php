<?php

namespace Nurzzzone\AdminPanel\Support\Form;

/**
 * @className Select
 * @package Nurzzzone\AdminPanel\Support\Form
 */
class Select extends Field
{
    /**
     * @var string
     */
    protected $type = 'select';

    /**
     * @var array|mixed
     */
    protected $options = [];

    public function __construct(string $label, string $columnName, array $options = [])
    {
        if (array_key_exists('options', $options)) {
            $this->options = $options['options'];
        }

        parent::__construct($label, $columnName, $options);
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->type,
            'options' => $this->options,
        ]);
    }
}
