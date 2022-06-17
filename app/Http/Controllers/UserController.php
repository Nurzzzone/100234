<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\BaseTableRepository;
use App\Repositories\UserTableRepository;
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

    protected function getRepository(): BaseTableRepository
    {
        return new UserTableRepository();
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
