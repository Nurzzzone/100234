<?php

namespace App\Http\Controllers;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Support\Facades\View;

class RoleController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Role::class;
    protected const COLUMNS = ['id' => 'id', 'name' => 'name'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'role';
        View::share('page_title', 'Роли');
    }

    public function index()
    {
        return view("pages.{$this->route}.index",
        [
            'objects' => (self::MODEL)::paginate(10),
            'columns' => self::COLUMNS,
            'route' => $this->route,
        ]);
    }

    public function create()
    {
        $model = self::MODEL;

        return view("pages.{$this->route}.create", [
            'object' => new $model(),
            'route' => $this->route,
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function show(Role $role)
    {
        return view("pages.{$this->route}.show", [
            'object' => $role,
            'route' => $this->route
        ]);
    }

    public function edit(Role $role)
    {
        return view("pages.{$this->route}.edit", [
            'object' => $role,
            'route' => $this->route
         ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function destroy(Role $role, Request $request)
    {
        try {
            $role->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }
}
