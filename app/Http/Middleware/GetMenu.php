<?php

namespace App\Http\Middleware;

use App\Http\Menus\GetSidebarMenu;
use App\Models\Menulist;
use App\Models\RoleHierarchy;
use Closure;
use Illuminate\Support\Facades\Auth;

class GetMenu
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = 'guest';

            $userRoles = Auth::user()->getRoleNames();

            $roleHierarchy = RoleHierarchy::select('role_hierarchy.role_id', 'roles.name')
                ->join('roles', 'roles.id', 'role_hierarchy.role_id')
                ->orderBy('role_hierarchy.hierarchy', 'asc')
                ->get();

            $flag = false;

            foreach ($roleHierarchy as $roleHier) {
                foreach ($userRoles as $userRole) {
                    if ($userRole == $roleHier['name']) {
                        $role = $userRole;
                        $flag = true;
                        break;
                    }
                }
                if ($flag === true) {
                    break;
                }
            }
        } else {
            $role = 'guest';
        }
        //session(['prime_user_role' => $role]);
        $menus = new GetSidebarMenu();
        $menulists = Menulist::all();
        $result = array();
        foreach ($menulists as $menulist) {
            $result[$menulist->name] = $menus->get($role, $menulist->id);
        }

        view()->share('appMenus', $result);

        return $next($request);
    }
}