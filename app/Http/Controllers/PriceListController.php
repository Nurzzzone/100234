<?php

namespace App\Http\Controllers;

use App\Exports\PriceListExport;
use App\Models\Finance\PriceListMailing;
use App\Models\News;
use App\Models\User;
use App\Repositories\BaseTableRepository;
use App\Repositories\Finance\PriceListMailingRepository;
use App\Repositories\Finance\PriceListRepository;
use App\Support\View\TableConfig\Finance\PriceListMailingTableConfig;
use App\Support\View\TableConfig\TableConfig;
use App\Traits\HasFlashMessage;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PriceListController extends TableController
{
    use HasFlashMessage;

    protected $route = 'priceList';
    protected $object;
    protected $pageTitle = 'Прайс листы';

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

    public function edit(PriceListMailing $priceList)
    {
        $manufacturers = DB::connection('adkulan_dev')
            ->table('1c_manufacturers')
            ->orderBy('name')
            ->pluck('name', 'GUID');

        return view("pages.$this->route.mailing", [
            'object' => $priceList,
            'route' => $this->route,
            'users' => User::query()->pluck('email', 'GUID'),
            'manufacturers' => $manufacturers,
            'intervals' => PriceListMailing::getIntervals(),
            'url' => route('priceList.update', $priceList->id),
            'method' => 'PATCH',
        ]);
    }

    public function update(Request $request, PriceListMailing $priceList, PriceListRepository $repository)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'manufacturers' => ['array', 'required', 'min:1', 'max:50'],
            'withRemains' => ['required' => 'boolean'],
            'withClientStores' => ['required' => 'boolean'],
            'withDiscount' => ['required', 'boolean'],
            'interval' => ['required', 'numeric']
        ]);

        $export = new PriceListExport($repository->getProducts(), $repository->stores(), $repository->getBusinessRegion());

        DB::connection('adkulan_dev')->table('price_list_mailing')->where('id', $priceList->id)->update([
            'user_id' => $request->user_id,
            'payload' => serialize($export),
            'config' => json_encode([
                'manufacturers' => DB::connection('adkulan_dev')->table('1c_manufacturers')->whereIn('GUID', $data['manufacturers'])->pluck('name'),
                'withRemains' => $data['withRemains']? 'С остатками': 'Без остатков',
                'withClientStores' => $data['withClientStores']? 'Со складами клиента': 'По всем',
                'withDiscount' => $data['withDiscount']? 'Со скидкой': 'Без скидки',
            ], JSON_UNESCAPED_UNICODE),
            'interval' => $request->interval,
        ]);

        return redirect()->route('priceList.mailingList');
    }

    public function mailingList()
    {
        return parent::index();
    }

    public function mailingForm()
    {
        $manufacturers = DB::connection('adkulan_dev')
            ->table('1c_manufacturers')
            ->orderBy('name')
            ->pluck('name', 'GUID');

        return view("pages.$this->route.mailing", [
            'object' => new PriceListMailing(),
            'route' => $this->route,
            'users' => User::query()->pluck('email', 'GUID'),
            'manufacturers' => $manufacturers,
            'intervals' => PriceListMailing::getIntervals(),
            'url' => route('priceList.mailingForm'),
            'method' => 'POST',
        ]);
    }

    public function mailing(Request $request, PriceListRepository $repository)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'manufacturers' => ['array', 'required', 'min:1', 'max:50'],
            'withRemains' => ['required' => 'boolean'],
            'withClientStores' => ['required' => 'boolean'],
            'withDiscount' => ['required', 'boolean'],
            'interval' => ['required', 'numeric']
        ]);

        $export = new PriceListExport($repository->getProducts(), $repository->stores(), $repository->getBusinessRegion());

        PriceListMailing::query()->insert([
            'user_id' => $request->user_id,
            'payload' => serialize($export),
            'config' => json_encode([
                'manufacturers' => DB::connection('adkulan_dev')->table('1c_manufacturers')->whereIn('GUID', $data['manufacturers'])->pluck('name'),
                'withRemains' => $data['withRemains']? 'С остатками': 'Без остатков',
                'withClientStores' => $data['withClientStores']? 'Со складами клиента': 'По всем',
                'withDiscount' => $data['withDiscount']? 'Со скидкой': 'Без скидки',
            ], JSON_UNESCAPED_UNICODE),
            'interval' => $request->interval,
            'mailed_at' => null,
            'mail_at' => now()->addMinutes($request->interval)->setTime(9, 0),
            'created_at' => now(),
        ]);

        return $this->flashSuccessMessage($request, "priceList.mailingForm");
    }

    protected function getRepository(): BaseTableRepository
    {
        return new PriceListMailingRepository();
    }

    protected function getTableConfig(): TableConfig
    {
        return new PriceListMailingTableConfig();
    }

    public function destroy(PriceListMailing $priceList, Request $request)
    {
        try {
            $priceList->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }

        return $this->flashSuccessMessage($request, "priceList.mailingList");
    }
}
