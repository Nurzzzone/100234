<?php

namespace App\Repositories\Marketing;

use App\Models\Contact;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    public function getPaginatedResult(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Contact::query()->paginate($this->perPageQuantity);
    }

    public function getPaginatedSearchResult()
    {
        return Contact::query()
            ->when(request('searchKeyword'), function($query) {
                $query
                    ->orWhere('name', 'LIKE', "%$this->searchQuery%")
                    ->orWhere('address', 'LIKE', "%$this->searchQuery%")
                    ->orWhere('email', 'LIKE', "%$this->searchQuery%");
            })
            ->paginate($this->perPageQuantity);
    }
}