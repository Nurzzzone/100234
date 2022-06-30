<?php

namespace App\Http\Controllers;

use App\Models\Product\ProductRemain;
use App\Repositories\RemainsTableRepository;
use App\Support\View\TableConfig\RemainsTableConfig;
use App\Traits\HasFlashMessage;
use App\Support\View\TableConfig\TableConfig;
use App\Repositories\BaseTableRepository;

class RemainsController extends TableController
{
    use HasFlashMessage;

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
