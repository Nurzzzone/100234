<?php

namespace App\Support\View\TableConfig\Marketing;

use App\Support\View\TableConfig\TableConfig;

class ContactTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('contact.index');
    }

    protected function columns(): array
    {
        return [
            [
                'label' => trans('fields.name'),
                'columnName' => 'parent.name',
            ],
            [
                'label' => trans('fields.address'),
                'columnName' => 'address',
            ],
            [
                'label' => trans('fields.email'),
                'columnName' => 'email',
            ],
        ];
    }
}