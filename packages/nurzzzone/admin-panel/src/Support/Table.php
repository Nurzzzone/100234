<?php

namespace Nurzzzone\AdminPanel\Support;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Table
 * @package Nurzzzone\AdminPanel\Support
 */
class Table extends Component
{
    public const COLUMN_TYPE_TEXT = 'text';
    public const COLUMN_TYPE_CHECK = 'check';
    public const COLUMN_TYPE_IMAGE = 'image';
    public const COLUMN_TYPE_TOGGLE = 'toggle';
    public const COLUMN_TYPE_SYNC_TOGGLE = 'syncToggle';
    public const FILTER_TYPE_DROPDOWN = 'dropdown';
    public const FILTER_TYPE_RADIO = 'radio';

    /**
     * @var bool
     */
    private $searchEnabled = false;

    /**
     * @var string
     */
    private $searchUrl;

    /**
     * @var bool
     */
    private $createEnabled = false;

    /**
     * @var string
     */
    private $createUrl;

    /**
     * @var bool
     */
    private $deleteEnabled = false;

    /**
     * @var bool
     */
    private $editEnabled = false;

    /**
     * @var bool
     */
    private $paginationEnabled = false;

    /**
     * @var string
     */
    protected $searchParam = 'searchKeyword';

    protected $searchQuery;

    protected $perPageQuantity;

    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var array
     */
    private $columns = [];

    public function getViewFilePath()
    {
        return view('admin-panel::index', $this->toArray());
    }

    public function enableSearch(string $searchUrl): self
    {
        $this->searchEnabled = true;

        $this->searchUrl = $searchUrl;

        return $this;
    }

    public function enableCreate(string $createUrl): self
    {
        $this->createEnabled = true;

        $this->createUrl = $createUrl;

        return $this;
    }

    public function enableDelete(): self
    {
        $this->deleteEnabled = true;

        return $this;
    }

    public function enableEdit(): self
    {
        $this->editEnabled = true;

        return $this;
    }

    public function enablePagination(): self
    {
        $this->paginationEnabled = true;

        return $this;
    }

    public function handleAjaxRequest()
    {
        $query = $this->model->query()
            ->when(request('searchKeyword'), function($query) {
                foreach($this->columns as $column) {
                    /**
                     * Если используется столбец из Join Clause-а, то нужно использовать значение указанное
                     * в этом ключе
                     */
                    if (array_key_exists('joinColumnName', $column)) {
                        $query->orWhere($column['joinColumnName'], 'LIKE', "%$this->searchQuery%");
                    }

                    /**
                     * Если в названии столбца есть точка, то нужно разделить их на связь и название столбца для
                     * фильтрации по связи/json столбцу (тип в бд)
                     */
                    else if (Str::contains($column['columnName'], '.')) {
                        [$relation, $column] = explode('.', $column['columnName']);

                        $this->queryRelationOrJsonColumn($query, $relation, $column);
                    }

                    /**
                     * Иначе нужно использовать обычный фильтр
                     */
                    else {
                        $query->orWhere($column['columnName'], 'LIKE', "%$this->searchQuery%");
                    }
                }
            })
            ->when(request()->filled('filters'), function($query) {
                $this->filterSearch($query);
            });

        if ($this->paginationEnabled) {
            return $query->paginate();
        }

        return $query->get();
    }

    protected function filterSearch(Builder $query)
    {
        foreach(json_decode(request('filters'), true) as $column => $value) {
            /**
             * Если значение пустое, то нужно перейти к следующей итерации
             */
            if (is_null($value)) {
                continue;
            }

            /**
             * Если в столбце есть точка, то нужно фильтровать по связи (фильтрация по json столбцу не реализована)
             */
            else if (Str::contains($column, '.')) {
                [$relation, $column] = explode('.', $column);

                $query->whereRelation($relation, $column, 'LIKE', "%$value%");
            }

            /**
             * Иначе нужно использовать обычный фильтр
             */
            else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }

    protected function queryRelationOrJsonColumn(Builder $query, $relation, $column)
    {
        /**
         * Для фильтрации по связи сущности, необходимо реализовать метод с названием $relation ($relation - это
         * название столбца до первой точки, который указан в TableConfig)
         */
        if (method_exists($this->model, $relation)) {
            $query->orWhereRelation($relation, $column, 'LIKE', "%$this->searchQuery%");
        }

        /**
         * Иначе фильтрация идет по json (тип в бд) столбцу
         */
        else {
            $query->orWhereRaw("LOWER(JSON_EXTRACT($relation, '$.\"$column\"')) LIKE LOWER('%$this->searchQuery%')");
        }
    }

    protected function tools(): array
    {
        return [
            'searchEnabled' => $this->searchEnabled,
            'searchUrl'     => $this->searchUrl,
            'createEnabled' => $this->createEnabled,
            'createUrl'     => $this->createUrl,
            'editEnabled'   => $this->editEnabled,
            'deleteEnabled' => $this->deleteEnabled
        ];
    }

    /**
     * @throws Exception
     */
    public function addColumn(string $label, string $columnName, string $type = 'text', ?string $joinColumnName = null): self
    {
        if (! in_array($type, $this->allowedColumnTypes())) {
            throw new Exception("Unknown column type: $type!");
        }

        $this->columns[] = compact('label', 'columnName', 'type', 'joinColumnName');

        return $this;
    }

    /**
     * @throws Exception
     */
    public function addFilter(string $label, string $paramName, string $type, array $options): self
    {
        if (!in_array($type, $this->allowedFilterTypes())) {
            throw new Exception("Unknown filter type: $type!");
        }

        if (!Arr::isAssoc($options)) {
            throw new Exception('Argument $options must be an associative array!');
        }

        $this->filters[] = compact('label', 'paramName', 'type', 'options');

        return $this;
    }

    protected function allowedColumnTypes(): array
    {
        return [
            self::COLUMN_TYPE_TEXT,
            self::COLUMN_TYPE_CHECK,
            self::COLUMN_TYPE_IMAGE,
            self::COLUMN_TYPE_TOGGLE,
            self::COLUMN_TYPE_SYNC_TOGGLE,
        ];
    }

    protected function allowedFilterTypes(): array
    {
        return [
            self::FILTER_TYPE_RADIO,
            self::FILTER_TYPE_DROPDOWN,
        ];
    }

    public function toArray(): array
    {
        return [
            'tools'     => $this->tools(),
            'columns'   => $this->columns,
            'filters'   => $this->filters,
        ];
    }

    public function toJson($options = 0): string
    {
        return collect($this->toArray())->toJson($options);
    }
}
