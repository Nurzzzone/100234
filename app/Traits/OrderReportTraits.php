<?php

namespace App\Traits;


use App\Models\Product;

trait OrderReportTraits
{
    public function delivery($model)
    {
        return [
            'status_id' => $model->statuses->hasStatus->id ?? null,
            'status_color' => $model->statuses->hasStatus->color ?? null,
            'status_name' => $model->statuses->hasStatus->name ?? null,
            'deliveryType' => $model->deliveryType->name ?? null,
            'store_id' => $model->stores->GUID ?? null,
            'store_name' => $model->stores->name ?? null,
            'address' => $model->addresses->address ?? null,
            'longitude' => $model->addresses->longitude ?? null,
            'latitude' => $model->addresses->latitude ?? null,
        ];
    }

    public function receiver($model)
    {
        return [
            'name' => $model->receivers->parent->FIO ?? null,
            'phone' => $model->receivers->parent->phone ?? null,
            'email' => $model->receivers->parent->email ?? null,
            'bin' => $model->receivers->bin ?? null,
            'is_partner' => $model->receivers->is_partner ?? null,
        ];
    }

    public function payments($model) //TODO переделать
    {
        return [
            'type' => 'Юридическое лицо',
            'product_count' => 2,
            'order_amounts' => $model->total->sum ?? null,
            'delivery' => 'Бесплатно',
            'bonus_pay' => 1150,
            'total_sum' => 10070,
            'bonus' => 350,
            'pay_type' => 'Картой',
        ];
    }

    public function products($model)
    {
        return $model->orderProducts->map(function ($order) use ($model) {
            $partnerProductInfo = json_decode($order->partner_product_data, true);
            return [
                'product_id' => $order->product ?? null,
                'product_name' => $order->products->name ?? $partnerProductInfo['product_name'] ?? null,
                'brand_id' => $order->products->brands->GUID ?? $partnerProductInfo['brand_id'] ?? null,
                'brand_name' => $order->products->brands->name ?? $partnerProductInfo['brand_name'] ?? null,
                'article' => $order->products->article ?? $partnerProductInfo['article'] ?? null,
                'quantity' => $order->quantity ?? null,
                'price' => $order->price_without_discount ?? null,
                'discount_price' => $order->price_with_discount ?? null,
                'image' => $order->products->image->image ?? '',
            ];
        });
    }

}
