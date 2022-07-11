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

    public function __construct(array $options = [])
    {
        if (array_key_exists('model', $options)) {
            $this->from($options['model']);
        }
    }

    protected function availableRequestMethods(): array
    {
        return [
            Request::METHOD_PUT,
            Request::METHOD_POST,
            Request::METHOD_PATCH,
        ];
    }

    public function handleStoreRequest(): \Illuminate\Http\JsonResponse
    {
        dd($this->model);


        return response()->json(['message' => 'success']);
    }

    public function handleUpdateRequest(): \Illuminate\Http\JsonResponse
    {

        return response()->json(['message' => 'success']);
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
            'fields' => $this->fields
        ])->toJson();
    }

    public function render(): string
    {
        return view('admin-panel::form', ['form' => $this->toJson(256)]);
    }
}
