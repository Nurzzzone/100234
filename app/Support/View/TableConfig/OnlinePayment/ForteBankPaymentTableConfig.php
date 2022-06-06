<?php

namespace App\Support\View\TableConfig\OnlinePayment;

use App\Models\OnlinePayment\Payment;
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
            ['label' => trans('fields.is_sent'), 'columnName' => 'payment.is_sent', 'type' => 'check'],
        ];
    }

    protected function filters(): array
    {
        return [
            [
                'label' => 'Статус',
                'type' => 'dropdown',
                'paramName' => 'status',
                'options' => [
                    'CREATED' => 'Заказ создан',
                    'DECLINED' => 'Отказ в оплате',
                    'EXPIRED' => 'Время оплаты истекло',
                    'CANCELED' => 'Заказ отменен',
                    'ERROR' => 'Ошибка',
                    'CONNECTION_ERROR' => 'Ошибка подключения к серверу',
                ]
            ],
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