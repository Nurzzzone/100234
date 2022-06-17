<?php

namespace App\Repositories;

use App\Models\PartnershipApplication;
use Illuminate\Database\Eloquent\Builder;

class PartnerApplicationsTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return PartnershipApplication::query();
    }
}
