<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseTableRepository;
use Illuminate\Database\Eloquent\Builder;

class UserTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return User::query();
    }
}
