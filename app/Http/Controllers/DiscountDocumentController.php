<?php

namespace Modules\Discount\Http\Controllers;

use App\Traits\HasJsonResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\B2B\B2BClient;
use Modules\Auth\Support\Facade\Auth;
use Modules\Discount\Entities\Discount;
use Modules\Discount\Entities\DiscountDocument;

class DiscountDocumentController extends Controller
{
    use HasJsonResponse;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('discount::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('discount::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $fields = request()->all();
        //TODO добавить уникальный ключ на роль и discountable_id и документ
        //TODO удалить
        $fields['start_date'] = '2022-05-05 10:45:36';
        $fields['end_date'] = '2022-05-05 10:45:36';
        $fields['clients'] = B2BClient::limit(2)->pluck('GUID');


        $fields['type'] = 'manufacturer'; //TODO добавить логику

        $fields['discounts'] = [
            '00cc343b-143f-11e6-99ed-00155d648080' => 12,
            '00fbcd31-6905-11e6-b6a5-00155d648080' => 18,
        ];

        //TOdo Удалить

        if (!empty($fields)) {
            $document = DiscountDocument::create([ //TODO вынести в валидацию
                'type' => $fields['type'],
                'initiator_id' => Auth::id(),
                'is_active' => true,//TODO добавить логику
                'start_date' => $fields['start_date'],
                'end_date' => $fields['end_date']
            ]);
            $discounts = [];
            foreach ($fields['clients'] as $client) {
                foreach ($fields['discounts'] as $discountable_id => $percent) {
                    $discount = new Discount([
                        'client' => $client,
                        'document_id' => $document->id,
                        'discountable_id' => $discountable_id,
                        'percent' => $percent,
                    ]);
                    array_push($discounts, $discount);
                }
            }

            $document->discounts()->saveMany($discounts);
        }

        return $this->sendSuccessMessage();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('discount::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('discount::edit');
    }


    public function update(Request $request, $id)
    {
        $fields = request()->all();
        //TODO добавить уникальный ключ на роль и discountable_id
        $fields['start_date'] = '2022-05-05 10:45:36';
        $fields['end_date'] = '2022-05-05 10:45:36';
        $fields['clients'] = B2BClient::limit(12)->pluck('GUID');

        $fields['type'] = 'manufacturer'; //TODO добавить логику

        $fields['discounts'] = [
            '00cc343b-143f-11e6-99ed-00155d648080' => 10,
            '00fbcd31-6905-11e6-b6a5-00155d648080' => 19,
            '00fbcd31-6905-11e6-b6a5-00155d648081' => 12,
        ];


        $document = DiscountDocument::find($id);
        if ($document) {
            $discounts = [];
            foreach ($fields['clients'] as $client) {
                foreach ($fields['discounts'] as $discountable_id => $percent) {
                    $discount = [
                        'client' => $client,
                        'discountable_id' => $discountable_id,
                        'percent' => $percent,
                        'document_id' => $id,
                    ];
                    array_push($discounts, $discount);
                }
            }

            Discount::upsert($discounts,
                ['client', 'discountable_id', 'document_id'],
                ['percent']
            );
        }

        return $this->sendSuccessMessage();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DiscountDocument::find($id)->delete();
    }
}
