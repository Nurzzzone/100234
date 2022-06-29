<?php

namespace App\Support\View\TableConfig\OnlinePayment;

use App\Models\OnlinePayment\Payment;
use App\Support\View\TableConfig\TableConfig;

class KaspiQrPaymentTableConfig extends TableConfig
{
    protected $createEnabled = false;

    protected $deleteEnabled = false;

    protected $editEnabled = false;

    public function __construct()
    {
        $this->searchUrl = route('kaspiQrPayment.index');
    }

    protected function columns(): array
    {
        return [
            ['label' => 'Идентификатор платежа в ПС', 'columnName' => 'bank_payment_id'],
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
                    'Processed' => 'Оплата прошла успешно',
                    'QrTokenCreated' => 'Ссылка на оплату успешно создана',
                    'Wait' => 'Ссылка успешно активирована пользователем и ожидает оплаты',
                    'Error' => 'Произошла ошибка при проведении оплаты со стороны банка',
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