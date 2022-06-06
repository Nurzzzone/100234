<?php

namespace App\Http\Menus;

use App\MenuBuilder\RenderFromDatabaseData;
use App\Models\Menus;

class GetSidebarMenu implements MenuInterface
{
    public function get($roles, $menuId = 2)
    {
        $menuElements = Menus::query()
            ->join('menu_role', 'menus.id', 'menu_role.menus_id')
            ->select('menus.*')
            ->where('menus.menu_id', $menuId)
            ->where('menu_role.role_name', $roles)
            ->orderBy('menus.sequence')
            ->get();

        return (new RenderFromDatabaseData)->render($menuElements);
    }

    public function getAll($menuId = 2)
    {
        $menuElements = Menus::query()
            ->select('menus.*')
            ->where('menus.menu_id', $menuId)
            ->orderBy('menus.sequence')
            ->get();

        return (new RenderFromDatabaseData)->render($menuElements);
    }
}
