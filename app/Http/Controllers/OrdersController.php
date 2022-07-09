<?php

namespace App\Http\Controllers;

use App\Models\Orders\Order;
use Nurzzzone\AdminPanel\Controllers\TableController;
use Nurzzzone\AdminPanel\Support\Table;

class OrdersController extends TableController
{
    protected $pageTitle = 'Заказы';

    public function fromTable(): \Nurzzzone\AdminPanel\Support\Table
    {
        return (new Table())
            ->setBuilder(Order::query())
            ->enableSearch()
            ->enablePagination()
            ->addColumn(new Table\Column\Text('Идентификатор', 'GUID'))
            ->addColumn(new Table\Column\Text('ID клиента', 'client_id'))
            ->addColumn(new Table\Column\Text('Склад', 'store_name'))
            ->addColumn(new Table\Column\Text('Общая сумма', 'total_sum'))
            ->addColumn(new Table\Column\Text('Стоимость доставки', 'delivery_sum'));
    }
}
