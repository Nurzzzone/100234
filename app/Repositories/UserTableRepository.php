<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTableRepository extends BaseTableRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return User::query();
    }
}