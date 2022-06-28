<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\TableController;
use App\Models\User;
use App\Repositories\BaseTableRepository;
use App\Repositories\Users\UserTableRepository;
use App\Support\View\TableConfig\TableConfig;
use App\Support\View\TableConfig\Users\UserTableConfig;
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


    public function edit(User $user)
    {
        $user->load('roles', 'permissions', 'b2bInfo');

        return view("pages.{$this->route}.edit", [
            'object' => $user,
            'route' => $this->route
        ]);
    }
}
