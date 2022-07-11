<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nurzzzone\AdminPanel\Support\Contracts\Collectable;
use Nurzzzone\AdminPanel\Support\Contracts\Paginatable;
use Nurzzzone\AdminPanel\Support\Table\Column\Column;
use Nurzzzone\AdminPanel\Support\Table\Filter\Filter;

/**
 * Class Table
 * @package Nurzzzone\AdminPanel\Support
 */
class Table implements Arrayable, Jsonable, Renderable, Paginatable, Collectable
{
    use WithBuilder, WithUrlDependencies;

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
    protected $searchQuery;

    /**
     * @var int
     */
    protected $perPageParam = 10;

    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var array
     */
    private $columns = [];

    public function __construct(array $options = [])
    {
        if (array_key_exists('builder', $options)) {
            $this->builder = $options['builder'];
        }
    }

    /**
     * Check if objects pagination in table enabled
     *
     * @return bool
     */
    public function isPaginationEnabled(): bool
    {
        return $this->paginationEnabled;
    }

    /**
     * Enable ajax searching in table
     *
     * @param ?string $searchUrl
     * @return $this
     */
    public function enableSearch(?string $searchUrl = null): self
    {
        $this->searchEnabled = true;

        $this->searchUrl = $searchUrl ?? url()->current();

        return $this;
    }

    /**
     * Enable create button
     *
     * @param string $createUrl
     * @return $this
     */
    public function enableCreate(string $createUrl): self
    {
        $this->createEnabled = true;

        $this->createUrl = $createUrl;

        return $this;
    }

    /**
     * Enable delete object button
     *
     * @return $this
     */
    public function enableDelete(): self
    {
        $this->deleteEnabled = true;

        return $this;
    }

    /**
     * Enable edit object button
     *
     * @return $this
     */
    public function enableEdit(): self
    {
        $this->editEnabled = true;

        return $this;
    }

    /**
     * Show table with pagination
     *
     * @return $this
     */
    public function enablePagination(): self
    {
        $this->paginationEnabled = true;

        return $this;
    }

    /**
     * Set search input value from request
     *
     * @return $this
     */
    protected function setSearchQuery(): self
    {
        $this->searchQuery = request('searchKeyword');

        return $this;
    }

    public function handle()
    {
        $this->setSearchQuery();

        return $this->builder
            ->when($this->searchQuery, function($query) {
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
    }

    /**
     * @param mixed $query
     */
    protected function filterSearch($query)
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
            else if ($this->builder instanceof EloquentBuilder && Str::contains($column, '.')) {
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

    /**
     * @param mixed $query
     * @param string $relation
     * @param string $column
     */
    protected function queryRelationOrJsonColumn($query, string $relation, string $column)
    {
        /**
         * Для фильтрации по связи сущности, необходимо реализовать метод с названием $relation ($relation - это
         * название столбца до первой точки, который указан в TableConfig)
         */
        if ($this->builder instanceof EloquentBuilder && method_exists($this->builder->getModel(), $relation)) {
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
            'searchEnabled'     => $this->searchEnabled,
            'searchUrl'         => $this->searchUrl,
            'createEnabled'     => $this->createEnabled,
            'createUrl'         => $this->createUrl,
            'editEnabled'       => $this->editEnabled,
            'deleteEnabled'     => $this->deleteEnabled,
            'paginationEnabled' => $this->paginationEnabled
        ];
    }

    public function objects(): array
    {
        if ($this->isPaginationEnabled()) {
            return ['pagination' => $this->pagination()];
        }

        return ['collection' => $this->collection()];
    }

    /**
     * Add column into table
     *
     * @param Column $column
     * @return $this
     */
    public function addColumn(Column $column): self
    {
        $this->columns[] = $column->toArray();

        return $this;
    }

    /**
     * Add filter into table
     *
     * @param Filter $filter
     * @return $this
     */
    public function addFilter(Filter $filter): self
    {
        $this->filters[] = $filter->toArray();

        return $this;
    }

    /**
     * Get Pagination instance
     *
     * @return AbstractPaginator
     */
    public function pagination(): AbstractPaginator
    {
        return $this->handle()->paginate($this->perPageParam);
    }

    /**
     * Get Collection instance
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->handle()->get();
    }

    public function render()
    {
        return view('admin-panel::index', ['table' => $this->toJson(256)]);
    }

    /**
     * Convert instance to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_merge([
            'tools'     => $this->tools(),
            'columns'   => $this->columns,
            'filters'   => $this->filters,
        ], $this->objects());
    }

    /**
     * Convert instance to json
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return collect($this->toArray())->toJson($options);
    }
}
