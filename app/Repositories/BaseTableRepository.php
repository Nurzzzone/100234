<?php

namespace App\Repositories;

use App\Support\View\TableConfig\TableConfig;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class BaseTableRepository
{
    protected $searchParam = 'searchKeyword';

    protected $perPageParam = 'perPage';

    protected $searchQuery;

    protected $perPageQuantity;

    protected $tableConfig;

    public function __construct()
    {
        $this->searchQuery = request($this->searchParam);
        $this->perPageQuantity = request($this->perPageParam, 10);
    }

    /**
     * Метод возвращает запрос в базу данных, который может фильтровать или
     * запрашивать связи перед тем, как использовать пагинацию.
     */
    abstract protected function beforePaginateQuery(): Builder;

    public function getTableConfig()
    {
        return $this->tableConfig;
    }

    public function setTableConfig(TableConfig $value): BaseTableRepository
    {
        $this->tableConfig = $value;

        return $this;
    }

    protected function getTableColumns(): array
    {
        $tableConfig = $this->getTableConfig()->toArray();

        return Arr::pluck($tableConfig['columns'], 'columnName');
    }

    final public function getPaginatedSearchResult(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->beforePaginateQuery()
            ->when(request('searchKeyword'), function($query) {
                foreach($this->getTableColumns() as $column) {
                    $query->orWhere($column, 'LIKE', "%$this->searchQuery%");
                }
            })
            ->when(request()->filled('filters'), function($query) {
                $this->filterSearch($query);
            })
            ->paginate($this->perPageQuantity);
    }

    final public function getPaginatedResult(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->beforePaginateQuery()->paginate($this->perPageQuantity);
    }

    protected function filterSearch(Builder $query)
    {
        foreach(json_decode(request('filters'), true) as $column => $value) {
            if (is_null($value)) {
                continue;
            } elseif (Str::contains($column, '.')) {
                [$relation, $column] = explode('.', $column);

                $query->whereRelation($relation, $column, 'LIKE', "%$value%");
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }
}