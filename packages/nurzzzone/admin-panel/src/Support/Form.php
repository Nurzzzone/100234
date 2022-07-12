<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Nurzzzone\AdminPanel\Support\Form\Field;

/**
 * @className Form
 * @package Nurzzzone\AdminPanel\Support
 */
class Form implements Jsonable, Renderable
{
    use WithUrlDependencies;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var string
     */
    private $tableUrl;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $action;

    public function __construct(array $options = [])
    {
        if (array_key_exists('model', $options)) {
            $this->from($options['model']);
        }

        $this->action = url()->current();
    }

    public function handleStoreRequest(): \Illuminate\Http\JsonResponse
    {
        dd(request()->all());

        return response()->json(['message' => 'success']);
    }

    public function handleUpdateRequest(Model $model): \Illuminate\Http\JsonResponse
    {
        dd(request()->all());

        return response()->json(['message' => 'success']);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTableUrl(string $value): self
    {
        $this->tableUrl = $value;

        return $this;
    }

    /**
     * Model from which from created
     *
     * @param Model $model
     * @return $this
     */
    public function from(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function addField(Field $field): self
    {
        $this->fields[] = $field->toArray();

        return $this;
    }

    public function toJson($options = 0): string
    {
        return collect([
            'fields' => $this->fields,
            'action' => $this->action,
            'method' => $this->method,
        ])->toJson();
    }

    public function render(): string
    {
        return view('admin-panel::form', ['form' => $this->toJson(256)]);
    }
}
