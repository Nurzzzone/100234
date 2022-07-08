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
}
