<?php

namespace App\Repositories\Marketing;

use App\Models\Contact;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class ContactTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return Contact::query()->with('parent');
    }
}