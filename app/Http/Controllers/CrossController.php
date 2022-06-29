<?php

namespace App\Http\Controllers;

use App\Models\Cross;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cross\CreateCrossRequest;
use App\Http\Requests\Cross\UpdateCrossRequest;
use Illuminate\Support\Facades\View;

class CrossController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Cross::class;
    protected const COLUMNS = [];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'cross';
        View::share('page_title', 'Кроссы');
    }

    public function index()
    {
        return view("pages.$this->route.create",
        [
            'object' => (self::MODEL),
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

    public function store(CreateCrossRequest $request)
    {
        try {
            (self::MODEL)::query()->updateOrCreate($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy()
    {
        $model = self::MODEL;

        return view("pages.$this->route.destroy", [
            'object' => new $model(),
            'route' => $this->route
        ]);
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'main_article' => 'required|max:255',
            'repl_article' => 'required|max:255',
        ]);

        try {
            Cross::where('main_article', $validated['main_article'])
                ->where('repl_article', $validated['repl_article'])
                ->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.destroy");
    }
}
