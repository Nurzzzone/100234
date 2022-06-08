<?php

namespace App\Http\Controllers;

use App\Http\Requests\Help\CreateHelpRequest;
use App\Http\Requests\Help\UpdateHelpRequest;
use App\Models\Outside\PopularCategory;
use App\Models\StaticPages\Help;
use App\Traits\HasFlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HelpController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Help::class;
    protected const COLUMNS = ['title' => 'title'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'help';
        View::share('page_title', 'Помощь');
    }

    public function index()
    {
        return view("pages.$this->route.index",
        [
            'objects' => (self::MODEL)::query()->orderBy('order')->paginate(10),
            'columns' => self::COLUMNS,
            'route' => $this->route,
        ]);
    }

    public function create()
    {
        $model = self::MODEL;

        return view("pages.$this->route.create", [
            'object' => new $model(),
            'route' => $this->route,
        ]);
    }

    public function store(CreateHelpRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(Help $help)
    {
        return view("pages.$this->route.show", [
            'object' => $help,
            'route' => $this->route
        ]);
    }

    public function edit(Help $help)
    {
        return view("pages.$this->route.edit", [
            'object' => $help,
            'route' => $this->route
         ]);
    }

    public function update(UpdateHelpRequest $request, Help $help)
    {
        try {
            $help->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(Help $help, Request $request)
    {
        try {
            $help->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function updateSequence(Request $request)
    {
        foreach($request->sequence as $sequence) {
            Help::query()->whereKey($sequence['id'])->update([
                'order' => $sequence['sequence'],
            ]);
        }

        return response()->json(['message' => 'success']);
    }
}
