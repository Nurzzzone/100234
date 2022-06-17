<?php

namespace App\Repositories\Finance;

use App\Models\BusinessRegion;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class PriceListRepository
{
    private static $products;

    public function getProducts()
    {
        return static::$products = Product::query()
            ->with('productRemains', 'productRemains.productStore')
            ->leftJoin('1c_manufacturers', '1c_products.manufacturer', '1c_manufacturers.guid')
            ->when(request('priceListType') == 0, function (Builder $query) {
                $query->whereIn('1c_manufacturers.guid', request('manufacturers'));
            }, function (Builder $query) {
                $priceGroup = request('priceGroup') == 0 ? '1c95a9b3-b933-11e1-8447-3c4a92fa410f' : '60a63d65-eeeb-11e4-ab38-00155d648080';
                $query->where('1c_products.price_group', $priceGroup);
            })
            ->when(request('withRemains') == 1, function ($query) {
                $query->has('productRemains.productStore');
            })
            ->when(request('withClientStores') == 1, function (Builder $query) {
                $query
                    ->leftJoin('1c_products_remains', '1c_products_remains.product', '1c_products.guid')
                    ->leftJoin('1c_stores', '1c_stores.guid', '1c_products_remains.store')
                    ->leftJoin('b2b_clients', 'b2b_clients.business_region', '1c_stores.business_region')
                    ->leftJoin('1c_users', '1c_users.owner', 'b2b_clients.guid')
                    ->where('1c_users.guid', request('user_id'));
            })
            ->leftJoin('1c_marks', '1c_marks.guid', '1c_products.brand')
            ->leftJoin('1c_prices', function (JoinClause $join) {
                $join->on('1c_prices.product', '1c_products.guid')
                    // TODO переписать стоит оптовая
                    ->where('1c_prices.price_type', '62211de3-0e78-11e9-b693-00155d648092');
            })
            ->select([
                '1c_products.GUID',
                '1c_manufacturers.name as manufacturerName',
                '1c_marks.name as productBrand',
                '1c_products.code as productCode',
                '1c_products.article as productArticle',
                '1c_products.name as productName',
                '1c_products.barcode as productBarcode',
                '1c_products.applicability as productApplicability',
                '1c_prices.price as productPrice',
                '1c_products.minorderquantity as minQuantity',
            ])
            ->distinct()
            ->orderBy('1c_products.article')
            ->get();
    }

    public function stores()
    {
        if (! request('withRemains')) {
            return collect();
        }

        return static::$products
            ->pluck('productRemains')
            ->flatten()
            ->unique('store')
            ->pluck('productStore')
            ->flatten()
            ->pluck('name', 'GUID')
            ->sort();
    }

    public function getBusinessRegion(): BusinessRegion
    {
        return BusinessRegion::query()
            ->leftJoin('b2b_clients', 'b2b_clients.business_region', '1c_business_regions.guid')
            ->leftJoin('1c_users', '1c_users.owner', 'b2b_clients.guid')
            ->where('1c_users.guid', request('user_id'))
            ->first(['1c_business_regions.address']);
    }
}