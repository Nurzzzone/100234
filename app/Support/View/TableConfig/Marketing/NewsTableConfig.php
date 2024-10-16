<?php

namespace App\Support\View\TableConfig\Marketing;

use App\Support\View\TableConfig\TableConfig;

class NewsTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $searchEnabled = false;

    protected function columns(): array
    {
        return [
            [
                'label' => trans('fields.title'),
                'columnName' => 'title'
            ],
            [
                'label' => trans('fields.description'),
                'columnName' => 'description'
            ],
            [
                'label' => trans('fields.is_active'),
                'columnName' => 'is_active',
                'type' => 'toggle'
            ],
            [
                'label' => trans('fields.image'),
                'columnName' => 'image'
            ]
        ];
    }
}
