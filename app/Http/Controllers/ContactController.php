<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\Contact;
use App\Repositories\BaseRepository;
use App\Repositories\Marketing\ContactRepository;
use App\Support\View\TableConfig\Marketing\ContactTableConfig;
use App\Support\View\TableConfig\TableConfig;
use App\Traits\HasFlashMessage;
use Illuminate\Support\Facades\DB;

class ContactController extends TableController
{
    use HasFlashMessage;

    protected $route = 'route';

    protected $pageTitle = 'Контакты';

    protected function getRepository(): BaseRepository
    {
        return new ContactRepository();
    }

    protected function getTableConfig(): TableConfig
    {
        return new ContactTableConfig();
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
