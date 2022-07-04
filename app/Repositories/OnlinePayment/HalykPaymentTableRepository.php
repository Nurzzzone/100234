<?php

namespace App\Repositories\OnlinePayment;

use App\Models\OnlinePayment\HalykBankPayment;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class HalykPaymentTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return HalykBankPayment::query()
            ->with('payment')
            ->orderBy('created_at', 'DESC');
    }
}