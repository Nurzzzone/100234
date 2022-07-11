<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Nurzzzone\AdminPanel\Support\Form\Field;

/**
 * @className Form
 * @package Nurzzzone\AdminPanel\Support
 */
class Form implements Arrayable, Renderable
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    private $fields = [];

    public function __construct(array $options = [])
    {
        if (array_key_exists('model', $options)) {
            $this->from($options['model']);
        }
    }

    public function addField(Field $field): self
    {
        $this->fields[] = $field->toArray();

        return $this;
    }

    public function from(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'fields' => $this->fields,
        ];
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
