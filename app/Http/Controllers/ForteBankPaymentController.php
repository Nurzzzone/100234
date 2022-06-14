<?php

namespace App\Http\Controllers;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\BaseRepository;
use App\Repositories\OnlinePayment\FortePaymentRepository;
use App\Support\View\TableConfig\OnlinePayment\ForteBankPaymentTableConfig;
use App\Support\View\TableConfig\TableConfig;

class ForteBankPaymentController extends TableController
{
    protected $pageTitle = 'Forte Bank';

    protected $route = 'forteBankPayment';

    protected function getRepository(): BaseRepository
    {
        return new FortePaymentRepository();
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
