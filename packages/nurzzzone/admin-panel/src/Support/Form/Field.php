<?php

namespace Nurzzzone\AdminPanel\Support\Form;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @className Field
 * @package Nurzzzone\AdminPanel\Support\Form
 */
class Field implements Arrayable
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
    protected $columnName;

    /**
     * @var bool
     */
    protected $required;

    public function __construct(string $label, string $columnName, array $options = [])
    {
        if (array_key_exists('required', $options)) {
            $this->required = $options['required'];
        }

        $this->label = $label;
        $this->columnName = $columnName;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'columnName' => $this->columnName,
            'required' => $this->required,
            'type' => $this->type,
        ];
    }
}
