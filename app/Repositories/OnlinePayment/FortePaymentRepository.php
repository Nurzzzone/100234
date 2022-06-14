<?php

namespace App\Repositories\OnlinePayment;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\BaseRepository;
use App\Support\View\TableConfig\OnlinePayment\ForteBankPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class FortePaymentRepository extends BaseRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return ForteBankPayment::query()
            ->with('payment')
            ->orderBy('created_at', 'DESC');
    }
}