<?php

namespace App\Support\View\EntityColumns;

class UserTableConfig extends TableConfig
{
    protected $deleteEnabled = false;

    protected $editEnabled = false;

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