<?php

namespace App\Repositories\Marketing;

use App\Models\Contact;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class ContactRepository extends BaseRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return Contact::query()->with('parent');
    }
}