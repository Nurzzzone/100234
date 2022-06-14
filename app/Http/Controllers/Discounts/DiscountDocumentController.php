<?php

namespace App\Http\Controllers\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountDocument\UpdateDiscountDocumentRequest;
use App\Models\Discount\Discount;
use App\Models\Discount\DiscountDocument;
use App\Models\Product\ProductManufacturer;
use App\Models\SalesAgent;
use App\Traits\HasFlashMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DiscountDocumentController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = DiscountDocument::class;
    protected const COLUMNS = [
        'id' => 'id',
        'name' => 'name',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
        'created_at' => 'created_at',
    ];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'discount.document';
        View::share('page_title', 'Документ скидок');
    }

    public function index()
    {
        return view("pages.{$this->route}.index",
            [
                'objects' => (self::MODEL)::where('initiator_id', Auth::id())->paginate(10),
                'columns' => self::COLUMNS,
                'route' => $this->route,
            ]);
    }

    public function create()
    {
        $model = self::MODEL;
        $managerClients = SalesAgent::where('manager', Auth::id())
            ->join('b2b_clients', 'client', 'GUID')
            ->get()
            ->pluck('contragent_name', 'GUID');

        return view("pages.{$this->route}.create", [
            'object' => new $model(),
            'test' => [],
            'selectedBrands' => [],
            'selectedClients' => [],
            'manufacturers' => ProductManufacturer::get()->pluck('name', 'GUID'),
            'clients' => $managerClients,
            'route' => $this->route,
        ]);
    }

    public function store(Request $request)
    {
        $fields = request()->all();
        //TODO добавить уникальный ключ на роль и discountable_id и документ
        try {
            if (!empty($fields)) {
                $document = DiscountDocument::create([ //TODO вынести в валидацию
                    'initiator_id' => Auth::id(),
                    'is_active' => true,//TODO добавить логику
                    'start_date' => $fields['start_date'],        //TODO валидация дат!!!
                    'end_date' => $fields['end_date']
                ]);
                $brand_discounts = [];
                foreach ($fields['clients'] as $client) {
                    foreach ($fields['brand_discounts'] as $discountable) {
                        $discount = new Discount([
                            'client_id' => $client['client'],
                            'document_id' => $document->id,
                            'discountable_id' => $discountable['brand'],
                            'percent' => $discountable['percent'],
                        ]);
                        array_push($brand_discounts, $discount);
                    }
                }
                $document->discounts()->saveMany($brand_discounts);
            }
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function show(DiscountDocument $document)
    {
        return view("pages.{$this->route}.show", [
            'object' => $document,
            'route' => $this->route
        ]);
    }

    public function edit($document)
    {
        //TODO вынести
        //TODO исправить $discountDocument

        $discountDocument = DiscountDocument::where('id', $document)
            ->with(['discounts' => function ($query) {
                $query->join('b2b_clients', 'client_id', 'b2b_clients.GUID')
                    ->join('1c_manufacturers', '1c_manufacturers.GUID', 'discounts.discountable_id')
                    ->select([
                        'document_id',
                        'discountable_id as manufacturer_id',
                        'client_id',
                        'b2b_clients.contragent_name',
                        '1c_manufacturers.name as manufacturer_name',
                        'discountable_id',
                        'percent'
                    ]);
            }])
            ->first();

        $managerClients = SalesAgent::where('manager', Auth::id())
            ->join('b2b_clients', 'client', 'GUID')
            ->get()
            ->pluck('contragent_name', 'GUID');

        return view("pages.{$this->route}.edit", [
            'object' => $discountDocument,
            'selectedBrands' => $discountDocument->discounts->unique('manufacturer_id', 'client_id'),
            'selectedClients' => $discountDocument->discounts->pluck('contragent_name', 'client_id')->unique(),
            'route' => $this->route,
            'manufacturers' => ProductManufacturer::get()->pluck('name', 'GUID'),
            'clients' => $managerClients,

        ]);
    }

    public function update(Request $request, DiscountDocument $document)
    {
        $fields = $request->all();
        try {
            $discounts = [];
            foreach ($fields['clients'] as $client) {
                foreach ($fields['brand_discounts'] as $discountable_id => $percent) {
                    $discount = [
                        'client_id' => $client['client'],
                        'discountable_id' => $discountable_id,
                        'percent' => $percent['percent'],
                        'document_id' => $document->id,
                        'start_date' => $document->start_date,
                        'end_date' => $document->end_date,
                    ];
                    array_push($discounts, $discount);
                }
            }

            Discount::upsert($discounts,
                ['client_id', 'discountable_id', 'document_id', 'start_date', 'end_date'],
                ['percent']
            );

        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function destroy(DiscountDocument $document, Request $request)
    {
        try {
            $document->delete();
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }
}
