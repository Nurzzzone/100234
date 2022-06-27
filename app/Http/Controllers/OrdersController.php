<?php

namespace App\Http\Controllers;

use App\Models\Orders\Order;
use App\Repositories\BaseTableRepository;
use App\Repositories\OrderTableRepository;
use App\Support\Services\OrderReportService;
use App\Support\View\TableConfig\OrdersTableConfig;
use App\Support\View\TableConfig\TableConfig;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;

class OrdersController extends TableController
{
    use HasFlashMessage;

    protected $route = 'orders';
    protected const MODEL = Order::class;

    protected $pageTitle = 'Пользователи';

    protected function getTableConfig(): TableConfig
    {
        return new OrdersTableConfig();
    }

    protected function getRepository(): BaseTableRepository
    {
        return new OrderTableRepository();
    }


    public function create()
    {
        $model = self::MODEL;

        return view("pages.$this->route.create", [
            'object' => new $model(),
            'route' => $this->route,
        ]);
    }

    public function store(CreateOrderRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(Order $order)
    {
        return view("pages.$this->route.show", [
            'object' => $order,
            'route' => $this->route
        ]);
    }

    public function edit(Order $order)
    {
        $orderInfo = (new OrderReportService())
            ->one($order->GUID);
//        dd($orderInfo);
        return view("pages.$this->route.edit", [
            'object' => $order,
            'orderInfo' => $orderInfo,
            'route' => $this->route
         ]);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            $order->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(Order $order, Request $request)
    {
        try {
            $order->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }
}
