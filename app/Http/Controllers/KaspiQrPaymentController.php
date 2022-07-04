<?php

namespace App\Http\Controllers;

use App\Repositories\BaseTableRepository;
use App\Repositories\OnlinePayment\KaspiQrPaymentTableRepository;
use App\Support\View\TableConfig\OnlinePayment\KaspiQrPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;
use App\Traits\HasFlashMessage;

class KaspiQrPaymentController extends TableController
{
    use HasFlashMessage;

    protected $route = 'kaspiQrPayment';
    protected $pageTitle = 'Kaspi QR';

    protected function getRepository(): BaseTableRepository
    {
        return new KaspiQrPaymentTableRepository();
    }

    protected function getTableConfig(): TableConfig
    {
        return new KaspiQrPaymentTableConfig();
    }
}
