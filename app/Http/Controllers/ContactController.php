<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Traits\HasFlashMessage;
use App\Http\Requests\Contact\UpdateContactRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Contact::class;
    protected const COLUMNS = [
        'name' => 'business_region',
        'address' => 'address',
        'email' => 'email'
    ];
    protected $route;

    public function __construct()
    {
        $this->route = 'contact';
        View::share('page_title', 'Контакты');
    }

    public function index()
    {
        return view("pages.{$this->route}.index",
        [
            'objects' => (self::MODEL)::paginate(10),
            'columns' => self::COLUMNS,
            'route' => $this->route,
        ]);
    }

    public function show(Contact $contact)
    {
        $contact->load('phones', 'schedules');

        return view("pages.{$this->route}.show", [
            'object' => $contact,
            'route' => $this->route,
        ]);
    }

    public function edit(Contact $contact)
    {
        $contact->load('phones', 'schedules');

        return view("pages.{$this->route}.edit", [
            'object' => $contact,
            'route' => $this->route,
        ]);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            $data = $request->validated();

            DB::transaction(function() use ($data, $contact) {
                $contact->update($data);

                foreach($data['phones'] as $id => $item) {
                    $contact->phones()->where('GUID', $id)->update(['phone' => $item]);
                }

                foreach($data['schedules'] as $id => $item) {
                    $contact->schedules()->where('GUID', $id)->update([
                        'start' => $item[0],
                        'end' => $item[1]
                    ]);
                }
            });
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }

        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }
}
