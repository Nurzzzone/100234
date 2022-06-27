<?php

namespace App\Repositories\Users;

use App\Models\PartnershipApplication;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class PartnerApplicationsTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return PartnershipApplication::query();
    }
}
