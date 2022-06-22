<?php

namespace App\Support\View\TableConfig;

class ManagerTableConfig  extends TableConfig
{

    protected $deleteEnabled = false;
    protected $createEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('managers.index');
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
