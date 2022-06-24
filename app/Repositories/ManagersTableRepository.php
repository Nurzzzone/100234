<?php

namespace App\Repositories;

use App\Models\Users\Manager;
use Illuminate\Database\Eloquent\Builder;


class ManagersTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return Manager::query();
    }
}
