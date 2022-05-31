<?php

namespace App\Support\View\TableConfig\OnlinePayment;

use App\Support\View\TableConfig\TableConfig;

class ForteBankPaymentTableConfig extends TableConfig
{
    protected $deleteEnabled = false;

    protected $editEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('forteBankPayment.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => 'Идентификатор сессии', 'columnName' => 'session_id'],
            ['label' => 'Идентификатор заказа', 'columnName' => 'order_id'],
            ['label' => 'Сумма', 'columnName' => 'payment.amount'],
            ['label' => 'Статус', 'columnName' => 'status_description'],
            ['label' => trans('fields.type'), 'columnName' => 'payment.type'],
            ['label' => trans('fields.is_sent'), 'columnName' => 'payment.is_sent'],
        ];
    }
}