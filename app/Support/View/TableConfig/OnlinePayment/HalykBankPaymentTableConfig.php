<?php

namespace App\Support\View\TableConfig\OnlinePayment;

use App\Models\OnlinePayment\Payment;
use App\Support\View\TableConfig\TableConfig;

class HalykBankPaymentTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    protected $editEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('halykBankPayment.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => 'Идентификатор платежа в ПС', 'columnName' => 'bank_payment_id'],
            ['label' => 'Сумма', 'columnName' => 'payment.amount'],
            ['label' => 'Статус', 'columnName' => 'reason'],
            ['label' => trans('fields.type'), 'columnName' => 'payment.type'],
            ['label' => trans('fields.is_sent'), 'columnName' => 'payment.is_sent', 'type' => 'check'],
        ];
    }

    protected function filters(): array
    {
        return [
            [
                'label' => trans('fields.type'),
                'type' => 'dropdown',
                'paramName' => 'payment.type',
                'options' => Payment::$types
            ],
            [
                'label' => trans('fields.is_sent'),
                'type' => 'radio',
                'paramName' => 'payment.is_sent',
                'options' => [
                    '0' => 'Не отправлен',
                    '1' => 'Отправлен'
                ]
            ]
        ];
    }
}