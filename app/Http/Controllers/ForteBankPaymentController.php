<?php

namespace App\Http\Controllers;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\BaseTableRepository;
use App\Repositories\OnlinePayment\FortePaymentTableRepository;
use App\Support\View\TableConfig\OnlinePayment\ForteBankPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;
use Nurzzzone\AdminPanel\Controllers\Controller;
use Nurzzzone\AdminPanel\Support\Table;

class ForteBankPaymentController extends \Nurzzzone\AdminPanel\Controllers\TableController
{
    protected $pageTitle = 'Forte Bank';

    public function fromTable(): Table
    {
        /** Should do this in repository class */
        $query = ForteBankPayment::query()
            ->with('payment')
            ->orderBy('created_at', 'DESC');

        /** Should do this in provider class */
        $statuses = [
            'APPROVED' => 'Оплачен',
            'CREATED' => 'Заказ создан',
            'DECLINED' => 'Отказ в оплате',
            'EXPIRED' => 'Время оплаты истекло',
            'CANCELED' => 'Заказ отменен',
            'ERROR' => 'Ошибка',
            'CONNECTION_ERROR' => 'Ошибка подключения к серверу',
        ];

        /** Should do this in provider class */
        $isSent = [
            '0' => 'Не отправлен',
            '1' => 'Отправлен'
        ];

        return (new Table($query))
            ->addColumn(new Table\Column\Text('Идентификатор сессии', 'session_id'))
            ->addColumn(new Table\Column\Text('Идентификатор заказа', 'order_id'))
            ->addColumn(new Table\Column\Text('Сумма', 'payment.amount'))
            ->addColumn(new Table\Column\Text('Статус', 'status_description'))
            ->addColumn(new Table\Column\Text('Тип', 'payment.type'))
            ->addColumn(new Table\Column\Text('Отправлен в 1С', 'payment.is_sent'))
            ->addFilter(new Table\Filter\Dropdown('Статус', 'status', $statuses))
            ->addFilter(new Table\Filter\Dropdown('Отправлен в 1С', 'payment.is_sent', $isSent));
    }
}
