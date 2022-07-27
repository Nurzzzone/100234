<?php

namespace Nurzzzone\AdminPanel\Controllers;

use App\Models\Menulist;
use App\Models\RoleHierarchy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Nurzzzone\AdminPanel\Support\Sidebar\GetSidebarMenu;
use Nurzzzone\AdminPanel\Support\Table;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * @var Table
     */
    protected $table;

    /**
     * @var string
     */
    protected $routeName;

    public function __construct()
    {
        \Illuminate\Support\Facades\View::share('pageTitle', $this->pageTitle);

        if (method_exists(static::class, 'fromTable')) {
            $this->table = $this->fromTable();
        }

        $this->renderSidebar();
    }

    public function renderSidebar()
    {
        $menus = new GetSidebarMenu();
        $menulists = Menulist::all();
        $result = array();
        foreach ($menulists as $menulist) {
            $result[$menulist->name] = $menus->get('Администратор', $menulist->id);
        }

        view()->share('appMenus', $result);
    }

    final public function index()
    {
        if (is_null($this->table)) {
            throw new \RuntimeException('Unable to render component.');
        }

        if (!empty($this->urlParams)) {
            $this->table->setUrlDependencies($this->urlParams, func_get_args());
        }

        if (!request()->ajax()) {
            return $this->table->render();
        }

        if (!$this->table->isPaginationEnabled()) {
            return $this->table->collection();
        }

        return $this->table->pagination();
    }

    public function create()
    {
        if (!method_exists(static::class, 'fromForm')) {
            throw new \RuntimeException('Cannot render unknown component.');
        }

        if (!request()->ajax()) {
            return $this->fromForm()->render();
        }

        return $this->fromForm()->handleStoreRequest();
    }

    public function edit()
    {
        if (!method_exists(static::class, 'fromForm')) {
            throw new \RuntimeException('Cannot render unknown component.');
        }

        if (!request()->ajax()) {
            return $this->fromForm()->render();
        }

        return $this->fromForm()->handleUpdateRequest();
    }

    public function destroy()
    {

    }

    public function getRouteName(): string
    {
        return $this->routeName;
    }

    public function appendRoute()
    {

    }
}
