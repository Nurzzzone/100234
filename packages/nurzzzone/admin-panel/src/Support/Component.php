<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

abstract class Component implements Arrayable, Jsonable
{
    /**
     * @var Model
     */
    protected $model;

    abstract public function getViewFilePath();

    abstract public function handleAjaxRequest();

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
