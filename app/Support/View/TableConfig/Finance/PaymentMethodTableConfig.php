<?php

namespace App\Support\View\TableConfig\Finance;

use App\Support\View\TableConfig\TableConfig;

class PaymentMethodTableConfig extends TableConfig
{
    protected $createEnabled = false;
    protected $editEnabled = false;
    protected $deleteEnabled = false;
    protected $searchEnabled = false;

    protected function columns(): array
    {
        return [
            [
                'label' => __('fields.name'),
                'columnName' => 'name'
            ],
            [
                'label' => __('fields.is_enabled'),
                'columnName' => 'is_active',
                'type' => 'syncToggle'
            ]
        ];
    }
}