<?php

namespace App\Http\Controllers;

use App\Models\OnlinePayment\ForteBankPayment;
use Nurzzzone\AdminPanel\Support\Table;

class ForteBankPaymentController extends \Nurzzzone\AdminPanel\Controllers\TableController
{
    protected $pageTitle = 'Forte Bank';

    public function fromTable(): Table
    {
        return (new Table())
            ->setBuilder(ForteBankPayment::query()->tableQuery())
            ->enablePagination()
            ->addColumn(new Table\Column\Text('Идентификатор сессии', 'session_id'))
            ->addColumn(new Table\Column\Text('Идентификатор заказа', 'order_id'))
            ->addColumn(new Table\Column\Text('Сумма', 'payment.amount'))
            ->addColumn(new Table\Column\Text('Статус', 'status_description'))
            ->addColumn(new Table\Column\Text('Тип', 'payment.type'))
            ->addColumn(new Table\Column\Text('Отправлен в 1С', 'payment.is_sent'))
            ->addFilter(new Table\Filter\Dropdown('Статус', 'status', ForteBankPayment::PAYMENT_STATUS))
            ->addFilter(new Table\Filter\Dropdown('Отправлен в 1С', 'payment.is_sent', [
                '0' => 'Не отправлен',
                '1' => 'Отправлен'
            ]));
    }
}
