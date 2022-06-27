<?php

namespace App\Repositories\Users;

use App\Models\Users\Manager;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;


class ManagersTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return Manager::query();
    }
}
