<?php

namespace App\Support\View\TableConfig;

use App\Models\OnlinePayment\Payment;
use App\Models\Product\Store;

class RemainsTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    protected $editEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('remains.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => trans('fields.name'), 'columnName' => 'productName', 'joinColumnName' => '1c_products.name'],
            ['label' => trans('fields.article'), 'columnName' => 'article'],
            ['label' => trans('fields.manufacturer'), 'columnName' => 'manufacturerName', 'joinColumnName' => '1c_manufacturers.name'],
            ['label' => trans('fields.article'), 'columnName' => 'productName', 'joinColumnName' => '1c_products.name'],
            ['label' => trans('fields.store'), 'columnName' => 'stores.name'],
            ['label' => trans('fields.count'), 'columnName' => 'quantity'],
            ['label' => trans('fields.price'), 'columnName' => 'price', 'joinColumnName' => '1c_prices.price'],
        ];
    }

    protected function filters(): array
    {
        return [
            [
                'label' => trans('fields.type'),
                'type' => 'dropdown',
                'paramName' => 'stores.GUID',
                'options' => Store::pluck('name', 'GUID')
            ],

        ];
    }
}

