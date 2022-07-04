<?php

namespace App\Http\Controllers;

use App\Repositories\BaseTableRepository;
use App\Repositories\OnlinePayment\HalykPaymentTableRepository;
use App\Support\View\TableConfig\OnlinePayment\HalykBankPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;
use App\Traits\HasFlashMessage;

class HalykBankPaymentController extends TableController
{
    use HasFlashMessage;

    protected $route = 'halykBankPayment';

    protected $pageTitle = 'Halyk Bank';

    protected function getRepository(): BaseTableRepository
    {
        return new HalykPaymentTableRepository();
    }

    protected function getTableConfig(): TableConfig
    {
        return new HalykBankPaymentTableConfig();
    }
}
