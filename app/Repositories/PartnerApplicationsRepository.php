<?php

namespace App\Repositories;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Models\PartnershipApplication;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PartnerApplicationsRepository extends BaseRepository
{
    public function getPaginatedResult()
    {
        return PartnershipApplication::query()
            ->paginate($this->perPageQuantity);
    }

    public function getPaginatedSearchResult()
    {
        return PartnershipApplication::query()
//            ->when(request('searchKeyword'), function($query) {
//                $query
//                    ->orWhere('payment_id', 'LIKE', "%$this->searchQuery%")
//                    ->orWhere('session_id', 'LIKE', "%$this->searchQuery%")
//                    ->orWhere('order_id', 'LIKE', "%$this->searchQuery%")
//                    ->orWhere('status_description', 'LIKE', "%$this->searchQuery%");
//            })
//            ->when(request()->filled('filters'), function($query) {
//                $this->filterSearch($query);
//            })
//            ->orderBy('created_at', 'DESC')
            ->paginate($this->perPageQuantity);
    }

    protected function filterSearch(Builder $query)
    {
        foreach(json_decode(request('filters'), true) as $column => $value) {
            if (is_null($value)) {
                continue;
            } elseif (Str::contains($column, '.')) {
                [$relation, $column] = explode('.', $column);

                $query->whereRelation($relation, $column, 'LIKE', "%$value%");
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }
}
