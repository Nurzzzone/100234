<?php

namespace App\Http\Controllers;

use App\Models\OnlinePayment\ForteBankPayment;
use App\Repositories\OnlinePayment\FortePaymentRepository;
use App\Support\View\TableConfig\OnlinePayment\ForteBankPaymentTableConfig;
use App\Traits\HasFlashMessage;
use Illuminate\Support\Facades\View;

class ForteBankPaymentController extends Controller
{
    use HasFlashMessage;

    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'forteBankPayment';
        View::share('page_title', 'Forte Bank');
    }

    public function index(FortePaymentRepository $repository, ForteBankPaymentTableConfig $tableConfig)
    {
        if (request()->ajax()) {
            return $repository->getPaginatedSearchResult();
        }

        return view("pages.index",
        [
            'objects' => $repository->getPaginatedResult(),
            'tableConfig' => $tableConfig,
            'route' => $this->route,
        ]);
    }

    public function show(ForteBankPayment $forteBankPayment)
    {
        return view("pages.$this->route.show", [
            'object' => $forteBankPayment,
            'route' => $this->route
        ]);
    }
}
