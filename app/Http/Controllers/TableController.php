<?php

namespace App\Http\Controllers;

use App\Repositories\BaseTableRepository;
use App\Support\View\TableConfig\TableConfig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

abstract class TableController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;

    protected $route;

    protected $pageTitle;

    abstract protected function getRepository(): BaseTableRepository;

    abstract protected function getTableConfig(): TableConfig;

    public function __construct()
    {
        if (! $repository = $this->getRepository()) {
            throw new \Exception('Class extending BaseController must have repository');
        }

        if (! $tableConfig = $this->getTableConfig()) {
            throw new \Exception('Class extending BaseController must have table config');
        }

        $this->repository = $repository->setTableConfig($tableConfig);
        View::share('page_title', $this->pageTitle);
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->repository->getPaginatedSearchResult();
        }

        return view("pages.index", [
            'objects' => $this->repository->getPaginatedResult(),
            'tableConfig' => $this->repository->getTableConfig(),
            'route' => $this->route,
        ]);
    }
}
