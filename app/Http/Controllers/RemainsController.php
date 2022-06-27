<?php

namespace App\Http\Controllers;

use App\Models\Product\ProductRemain;
use App\Repositories\RemainsTableRepository;
use App\Support\View\TableConfig\RemainsTableConfig;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Support\View\TableConfig\TableConfig;

use App\Http\Requests\Remains\CreateRemainsRequest;
use App\Http\Requests\Remains\UpdateRemainsRequest;
use App\Repositories\BaseTableRepository;

class RemainsController extends TableController
{
    use HasFlashMessage;

    protected const MODEL = ProductRemain::class;
    protected $object;


    protected $route = 'remains';

    protected $pageTitle = 'Остатки';

    protected function getTableConfig(): TableConfig
    {
        return new RemainsTableConfig();
    }

    protected function getRepository(): BaseTableRepository
    {

        return new RemainsTableRepository();
    }

}
