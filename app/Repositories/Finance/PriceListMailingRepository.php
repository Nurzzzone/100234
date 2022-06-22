<?php

namespace App\Repositories\Finance;

use App\Models\Finance\PriceListMailing;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class PriceListMailingRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return PriceListMailing::query()->with('user');
    }
}