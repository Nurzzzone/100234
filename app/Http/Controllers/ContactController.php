<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\Marketing\ContactRepository;
use App\Support\View\TableConfig\Marketing\ContactTableConfig;
use App\Traits\HasFlashMessage;
use App\Http\Requests\Contact\UpdateContactRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Contact::class;
    protected $route;

    public function __construct()
    {
        $this->route = 'contact';
        View::share('page_title', 'Контакты');
    }

    public function index(ContactRepository $repository, ContactTableConfig $tableConfig)
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
