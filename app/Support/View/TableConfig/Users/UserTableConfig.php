<?php

namespace App\Support\View\TableConfig\Users;

use App\Support\View\TableConfig\TableConfig;

class UserTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('user.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => trans('fields.id'), 'columnName' => 'GUID'],
            ['label' => trans('fields.FIO'), 'columnName' => 'FIO'],
            ['label' => trans('fields.email'), 'columnName' => 'email'],
            ['label' => trans('fields.phone'), 'columnName' => 'phone'],
        ];
    }
}
