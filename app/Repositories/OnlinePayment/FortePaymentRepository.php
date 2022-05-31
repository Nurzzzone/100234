<?php

namespace App\Repositories\OnlinePayment;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\BaseRepository;

class FortePaymentRepository extends BaseRepository
{
    public function getPaginatedResult()
    {
        return ForteBankPayment::query()->with('payment')->paginate($this->perPageQuantity);
    }

    public function getPaginatedSearchResult()
    {
        return ForteBankPayment::query()->with('payment')
            ->when(request('searchKeyword'), function($query) {
                $query
                    ->orWhere('payment_id', 'LIKE', "%$this->searchQuery%")
                    ->orWhere('session_id', 'LIKE', "%$this->searchQuery%")
                    ->orWhere('order_id', 'LIKE', "%$this->searchQuery%")
                    ->orWhere('status_description', 'LIKE', "%$this->searchQuery%");
            })
            ->paginate($this->perPageQuantity);
    }
}