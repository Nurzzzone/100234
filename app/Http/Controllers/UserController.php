<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Support\View\TableConfig\TableConfig;
use App\Support\View\TableConfig\UserTableConfig;
use App\Traits\HasFlashMessage;

class UserController extends TableController
{
    use HasFlashMessage;

    protected $route = 'user';

    protected $pageTitle = 'Пользователи';

    protected function getTableConfig(): TableConfig
    {
        return new UserTableConfig();
    }

    protected function getRepository(): BaseRepository
    {
        return new UserRepository();
    }

    public function show(User $user)
    {
        $user->load('roles', 'permissions');

        return view("pages.{$this->route}.show", [
            'object' => $user,
            'route' => $this->route
        ]);
    }
}
