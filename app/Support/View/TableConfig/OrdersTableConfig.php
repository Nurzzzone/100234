<?php

namespace App\Support\View\TableConfig;

class OrdersTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('orders.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => trans('fields.id'), 'columnName' => 'GUID'],
            ['label' => trans('fields.client_id'), 'columnName' => 'client'],
            ['label' => trans('fields.store'), 'columnName' => 'store_name'],
            ['label' => trans('fields.total_price'), 'columnName' => 'total_sum'],
            ['label' => trans('fields.delivery_sum'), 'columnName' => 'delivery_sum'],
        ];
    }
}
