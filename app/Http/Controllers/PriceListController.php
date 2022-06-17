<?php

namespace App\Http\Controllers;

use App\Exports\PriceListExport;
use App\Models\User;
use App\Repositories\Finance\PriceListRepository;
use App\Traits\HasFlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class PriceListController extends Controller
{
    use HasFlashMessage;

    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'priceList';
        View::share('page_title', 'Прайс Листы');
    }

    public function index()
    {
        $manufacturers = DB::connection('adkulan_dev')
            ->table('1c_manufacturers')
            ->orderBy('name')
            ->pluck('name', 'GUID');

        return view("pages.$this->route.create", [
            'route' => $this->route,
            'users' => User::query()->pluck('email', 'GUID'),
            'manufacturers' => $manufacturers,
        ]);
    }

    public function store(Request $request, PriceListRepository $repository)
    {
        $request->validate([
            'user_id' => ['required'],
            'manufacturers' => ['sometimes', 'array', 'required', 'min:1', 'max:50'],
            'priceGroup' => ['sometimes', 'required'],
            'withRemains' => ['required' => 'boolean'],
            'withClientStores' => ['required' => 'boolean'],
        ]);

        $export = new PriceListExport($repository->getProducts(), $repository->stores(), $repository->getBusinessRegion());

        return Excel::download($export, sprintf('ПРАЙС_ЛИСТ_%s.xlsx', now()->format('dmY')));
    }
}
