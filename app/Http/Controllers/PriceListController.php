<?php

namespace App\Http\Controllers;

use App\Exports\PriceListExport;
use App\Models\User;
use App\Repositories\Finance\PriceListRepository;
use App\Traits\HasFlashMessage;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function mailingForm()
    {
        $manufacturers = DB::connection('adkulan_dev')
            ->table('1c_manufacturers')
            ->orderBy('name')
            ->pluck('name', 'GUID');

        return view("pages.$this->route.mailing", [
            'route' => $this->route,
            'users' => User::query()->pluck('email', 'GUID'),
            'manufacturers' => $manufacturers,
            'intervals' => [
                CarbonInterval::day()->totalMinutes => 'раз в день (в 9:00)',
                CarbonInterval::days(2)->totalMinutes => 'раз в два дня (в 09:00 и 14:00)',
                CarbonInterval::week()->totalMinutes => 'раз в неделю (в понедельник в 9:00)',
                CarbonInterval::month()->totalMinutes => 'раз в месяц (один раз в месяц, с момента создания рассылки в 9:00)'
            ]
        ]);
    }

    public function mailing(Request $request, PriceListRepository $repository)
    {
        $request->validate([
            'user_id' => ['required'],
            'manufacturers' => ['array', 'required', 'min:1', 'max:50'],
            'withRemains' => ['required' => 'boolean'],
            'withClientStores' => ['required' => 'boolean'],
            'interval' => ['required', 'numeric']
        ]);

        $export = new PriceListExport($repository->getProducts(), $repository->stores(), $repository->getBusinessRegion());

        DB::table('price_list_mailing')->insert([
            'user_id' => $request->user_id,
            'payload' => serialize($export),
            'interval' => $request->interval,
            'mailed_at' => null,
            'mail_at' => now()->addMinutes($request->interval)->setTime(9, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $this->flashSuccessMessage($request, "priceList.mailingForm");
    }
}
