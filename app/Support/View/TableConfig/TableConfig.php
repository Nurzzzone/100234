<?php

namespace App\Support\View\TableConfig;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;

abstract class TableConfig implements Jsonable, Arrayable
{
    protected $searchEnabled = true;

    protected $createEnabled = true;

    protected $editEnabled = true;

    protected $deleteEnabled = true;

    protected $perPageButtonEnabled = true;

    protected $searchUrl;

    protected $createUrl;

    private const filterStructure = ['label', 'type', 'options', 'paramName'];

    private const allowedColumnTypes = ['text', 'check', 'toggle', 'image'];

    protected static $filterTypes = [
        'dropdown',
        'radio',
    ];

    /**
     * Метод возвращает массив в котором перечислены столбцы таблицы в базе данных
     * и надо отобразить в таблице в админ панели. В самом массиве label - это название
     * для отображения столбца, типа: Электронная почта, Имя и т.д., а columnName -
     * название столбца в таблице базе данных. Если необходимо отобразить связь, то можно
     * использовать точку relationName.relationColumnName (relationName это метод определенный
     * в классе Model)
     */
    abstract protected function columns(): array;

    final public function tools(): array
    {
        if ($this->searchEnabled && !$this->searchUrl) {
            throw new \Exception('searchUrl is not defined!');
        }

        if ($this->createEnabled && !$this->createUrl) {
            throw new \Exception('createUrl is not defined!');
        }

        return [
            'createEnabled'         => $this->createEnabled,
            'editEnabled'           => $this->editEnabled,
            'deleteEnabled'         => $this->deleteEnabled,
            'searchEnabled'         => $this->searchEnabled,
            'perPageButtonEnabled'  => $this->perPageButtonEnabled,
            'createUrl'             => $this->createUrl,
            'searchUrl'             => $this->searchUrl,
            'buttonsEnabled'        => $this->editEnabled || $this->deleteEnabled,
        ];
    }

    protected function filters(): array
    {
        return [];
    }

    /**
     * Метод проверяет правильность заполнения массива для столбцов.
     * P.S. сюда лезть не надо.
     */
    final protected function validateColumns() {
        if (empty($this->columns())) {
            return [];
        }

        if (Arr::isAssoc($this->columns())) {
            throw new \Exception('Associative array not allowed!');
        }

        foreach ($this->columns() as $column) {
            if (! Arr::isAssoc($column)) {
                throw new \Exception('Column must be associative array!');
            }

            if (! array_key_exists('columnName', $column)) {
                throw new \Exception('Key "columnName" is required!');
            }

            if (array_key_exists('type', $column) && ! in_array($column['type'], self::allowedColumnTypes)) {
                throw new \Exception('Allowed column types: text, check, toggle, image');
            }
        }

        return $this->columns();
    }

    /**
     * Метод проверяет правильность заполнения массива для фильтров.
     * P.S. сюда лезть не надо.
     */
    final protected function validatedFilters()
    {
        if (empty($this->filters())) {
            return [];
        }

        if (Arr::isAssoc($this->filters())) {
            throw new \Exception('Associative array not allowed!');
        }

        foreach($this->filters() as $filter) {
            if (! Arr::isAssoc($filter)) {
                throw new \Exception('Filter must be associative array!');
            }

            foreach(self::filterStructure as $key) {
                if (! array_key_exists('type', $filter)) {
                    throw new \Exception("Key $key is required!");
                }
            }

            if (empty($filter['type']) || empty($filter['options']) || empty($filter['paramName'])) {
                throw new \Exception('Values of keys are required: type, options, paramName!');
            }

            if (! in_array($filter['type'], static::$filterTypes)) {
                throw new \Exception('Allowed filter types: dropdown, checkbox!');
            }
        }

        return $this->filters();
    }

    public function toJson($options = 0): string
    {
        return collect($this->toArray())->toJson($options);
    }

    public function toArray(): array
    {
        return [
            'tools'     => $this->tools(),
            'columns'   => $this->validateColumns(),
            'filters'   => $this->validatedFilters(),
        ];
    }
}
