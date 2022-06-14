<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    protected function beforePaginateQuery(): Builder
    {
        return User::query();
    }
}