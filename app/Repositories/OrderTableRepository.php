<?php

namespace App\Repositories;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return Order::query();
    }
}
