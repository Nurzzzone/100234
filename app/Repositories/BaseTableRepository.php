<?php

namespace App\Repositories;

use App\Support\View\TableConfig\TableConfig;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->getTableConfig()->toArray()['columns'];
    }

    final public function getPaginatedSearchResult(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->beforePaginateQuery()
            ->when(request('searchKeyword'), function($query) {
                foreach($this->getTableColumns() as $column) {
                    if (array_key_exists('joinColumnName', $column)) {
                        $this->queryJoinColumn($query, $column['joinColumnName']);
                    } else if (Str::contains($column['columnName'], '.')) {
                        [$relation, $column] = explode('.', $column['columnName']);

                        $this->queryRelationOrJsonColumn($query, $relation, $column);
                    } else {
                        $query->orWhere($column['columnName'], 'LIKE', "%$this->searchQuery%");
                    }

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
            } else if (Str::contains($column, '.')) {
                [$relation, $column] = explode('.', $column);

                $query->whereRelation($relation, $column, 'LIKE', "%$value%");
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }

    protected function queryRelationOrJsonColumn(Builder $query, $relation, $column)
    {
        if (method_exists($this->beforePaginateQuery()->getModel(), $relation)) {
            $query->orWhereRelation($relation, $column, 'LIKE', "%$this->searchQuery%");
        } else {
            $query->orWhereRaw("LOWER(JSON_EXTRACT($relation, '$.\"$column\"')) LIKE LOWER('%$this->searchQuery%')");
        }
    }

    protected function queryJoinColumn(Builder $query, string $columnName)
    {
        $query->orWhere($columnName, 'LIKE', "%$this->searchQuery%");
    }
}
