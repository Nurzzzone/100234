<?php

namespace App\Support\View\TableConfig;

class PartnershipApplicationTableConfig extends TableConfig
{
    protected $deleteEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('partner.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => trans('fields.id'), 'columnName' => 'GUID'],
            ['label' => trans('fields.contragent_name'), 'columnName' => 'contragent_name'],
            ['label' => 'Сумма', 'columnName' => 'bin'],
            ['label' => trans('fields.phone'), 'columnName' => 'phone'],
            ['label' => trans('fields.email'), 'columnName' => 'email'],
            ['label' => trans('fields.is_sent'), 'columnName' => 'is_sent', 'type' => 'check'],
        ];
    }
}
