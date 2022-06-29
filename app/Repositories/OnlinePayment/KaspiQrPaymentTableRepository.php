<?php

namespace App\Repositories\OnlinePayment;

use App\Models\OnlinePayment\KaspiQrPayment;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class KaspiQrPaymentTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return KaspiQrPayment::query()->with('payment')->orderBy('created_at', 'DESC');
    }
}