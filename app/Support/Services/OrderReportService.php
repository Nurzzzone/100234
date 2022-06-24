<?php

namespace App\Support\Services;

use App\Models\Orders\Order;
use App\Traits\OrderReportTraits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderReportService
{
    use OrderReportTraits;

    const DIFFERENCE_TIME = 120;

    public $date;

    public $page;

    public $status;

//    public function all($type = 0, $search = false)
//    {
//        $query = Order::query();
//
//        if ($this->status) {
//            $query->whereIn('order_status_1c.site_status_id', $this->status);
//        }
//
//        if ($this->date) {
//            $query->whereBetween('orders.created_at', [$this->date->start_date, $this->date->end_date]);
//        }
//
//        $orders = $query->where('orders.client', Auth::id())
//            ->where('orders.archive', $type)
//            ->where('orders.cancelled', 0)
//            ->leftJoin('order_status_1c', 'order_status_1c.onec_status_id', '=', 'orders.status')
//            ->leftJoin('order_status', 'order_status.id', '=', 'order_status_1c.site_status_id')
//            ->leftJoin('1c_stores', '1c_stores.GUID', '=', 'orders.store_id')
//            ->select('orders.GUID as order_id',
//                'orders.number as order_number',
//                'orders.created_at as order_date',
//                'orders.store_id as store_id',
//                'orders.store_name as store_name',
//                'orders.total_sum as order_amount',
//                'order_status.id as status_id',
//                'order_status.name as status_name',
//                'order_status.color as color',
//                'orders.archive as archive',
//            )
//            ->orderBy('orders.number', 'desc');
//
//            if ($search) {
//                return $orders->get();
//            }
//
//        return new OrdersCollection($orders->paginate($this->page));
//    }

    public function one($id)
    {
        $order = Order::query()
            ->where('GUID', $id)
            ->with('statuses', 'stores', 'deliveryType', 'orderProducts.products.brands', 'receivers', 'receivers.parent')
            ->get()
            ->map(function ($model) {
                return [
                    'order_id'      => $model->GUID,
                    'order_number'  => $model->number,
                    'delivery_data' => $this->delivery($model),
                    'receiver'      => $this->receiver($model),
                    'payments'      => $this->payments($model),
                    'products'      => $this->products($model)
                ];
            });

        return $order[0] ?? [];
    }


    public function difference($order)
    {
        return Carbon::today()->timestamp - Carbon::parse($order->created_at)->timestamp;
    }

}
