<?php

namespace App\Http\Controllers;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\BaseTableRepository;
use App\Repositories\OnlinePayment\FortePaymentTableRepository;
use App\Support\View\TableConfig\OnlinePayment\ForteBankPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;

class ForteBankPaymentController extends TableController
{
    protected $pageTitle = 'Forte Bank';

    protected $route = 'forteBankPayment';

    protected function getRepository(): BaseTableRepository
    {
        return new FortePaymentTableRepository();
    }

    protected function getTableConfig(): TableConfig
    {
        return new ForteBankPaymentTableConfig();
    }

    public function show(ForteBankPayment $forteBankPayment)
    {
        return view("pages.$this->route.show", [
            'object' => $forteBankPayment,
            'route' => $this->route
        ]);
    }
}
