<?php

namespace App\Repositories;

use App\Models\Product\ProductRemain;
use Illuminate\Database\Eloquent\Builder;

class RemainsTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return ProductRemain::query()
            ->select([
                '1c_products_remains.store',
                '1c_products.name as productName',
                '1c_products.article',
                '1c_products.name as productName',
                '1c_manufacturers.name as manufacturerName',
                '1c_prices.price',
                '1c_products_remains.quantity'
            ])
            ->join('1c_products', 'product', '1c_products.GUID')
        ->join('1c_manufacturers', '1c_products.manufacturer', '1c_manufacturers.GUID')
        ->with('stores')
        ->join('1c_prices', function ($join) {
            $join->on('1c_products_remains.product', '=', '1c_prices.product');
            $join->where('1c_prices.price_type', '=', '62211de3-0e78-11e9-b693-00155d648092'); //TODO HARDCODE
        });

    }
}
