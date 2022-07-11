<?php

namespace Nurzzzone\AdminPanel\Controllers;

use App\Models\Menulist;
use App\Models\RoleHierarchy;
use Illuminate\Support\Facades\Auth;
use Nurzzzone\AdminPanel\Support\Contracts\FromForm;
use Nurzzzone\AdminPanel\Support\Contracts\FromTable;
use Nurzzzone\AdminPanel\Support\Form;
use Nurzzzone\AdminPanel\Support\Sidebar\GetSidebarMenu;
use Nurzzzone\AdminPanel\Support\Table;

class AdminController extends \Illuminate\Routing\Controller
{
    /**
     * @var string
     */
    protected $pageTitle;

    public function __construct()
    {
        \Illuminate\Support\Facades\View::share('pageTitle', $this->pageTitle);

        $this->renderSidebar();
    }

    final public function index()
    {
        $reflectionClass = new \ReflectionClass(static::class);

        if ($reflectionClass->implementsInterface(FromTable::class) && method_exists(static::class, 'fromTable')) {
            return $this->renderTableComponent($this->fromTable());
        }

        throw new \RuntimeException('Unable to render component');
    }

    final public function create()
    {
        $reflectionClass = new \ReflectionClass(static::class);

        if ($reflectionClass->implementsInterface(FromForm::class) && method_exists(static::class, 'fromForm')) {
            return $this->renderFormComponent($this->fromForm());
        }

        throw new \RuntimeException('Unable to render component');
    }

    protected function renderTableComponent(Table $table)
    {
        if (! request()->ajax()) {
            return $table->render();
        }

        if (! $table->isPaginationEnabled()) {
            return $table->collection();
        }

        return $table->pagination();
    }

    protected function renderFormComponent(Form $form)
    {

    }

    public function renderSidebar()
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
    }
}
