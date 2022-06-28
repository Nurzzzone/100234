<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\TableController;
use App\Models\Users\Manager;
use App\Repositories\BaseTableRepository;
use App\Repositories\Users\ManagersTableRepository;
use App\Support\View\TableConfig\Users\ManagerTableConfig;
use App\Support\View\TableConfig\TableConfig;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Requests\Manager\CreateManagerRequest;
use App\Http\Requests\Manager\UpdateManagerRequest;

class ManagerController extends TableController
{
    use HasFlashMessage;

    protected const MODEL = Manager::class;
    protected const COLUMNS = [];
    protected $object;
    protected $route = 'managers';
    protected $pageTitle = 'Пользователи';


    protected function getTableConfig(): TableConfig
    {
        return new ManagerTableConfig();
    }

    protected function getRepository(): BaseTableRepository
    {
        return new ManagersTableRepository();
    }



    public function create()
    {
        $model = self::MODEL;

        return view("pages.$this->route.create", [
            'object' => new $model(),
            'route' => $this->route,
        ]);
    }

    public function store(CreateManagerRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(Manager $manager)
    {
        return view("pages.$this->route.show", [
            'object' => $manager,
            'route' => $this->route
        ]);
    }

    public function edit(Manager $manager)
    {
        return view("pages.$this->route.edit", [
            'object' => $manager,
            'route' => $this->route
         ]);
    }

    public function update(UpdateManagerRequest $request, Manager $manager)
    {
        try {
            $manager->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(Manager $manager, Request $request)
    {
        try {
            $manager->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }
}
