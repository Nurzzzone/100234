<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Outside\PopularCategory;
use App\Repositories\Marketing\PopularCategoryRepository;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Requests\PopularCategory\CreatePopularCategoryRequest;
use App\Http\Requests\PopularCategory\UpdatePopularCategoryRequest;
use Illuminate\Support\Facades\View;

class PopularCategoryController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = PopularCategory::class;
    protected const COLUMNS = ['name' => 'name', 'is_active' => 'is_active'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'popularCategory';
        View::share('page_title', 'Популярные категорий');
    }

    public function index(PopularCategoryRepository $repository)
    {
        return view("pages.$this->route.index",
        [
            'objects' => $repository->getObjects(),
            'columns' => self::COLUMNS,
            'route' => $this->route,
        ]);
    }

    public function create(PopularCategoryRepository $repository)
    {
        $model = self::MODEL;

        return view("pages.$this->route.create", [
            'object' => new $model(),
            'route' => $this->route,
            'hierarchies' => $repository->getAvailableOptions(),
        ]);
    }

    public function store(CreatePopularCategoryRequest $request, PopularCategoryRepository $repository)
    {
        (self::MODEL)::create([
            'GUID' => uuid4(),
            'hierarchy_id' => $request->hierarchy_id,
            'hierarchy_type' => 'adkulan_hierarchy',
            'description' => $request->description,
            'sequence' => $repository->getLatestSequence(),
            'is_active' => $request->is_active
        ]);

        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(PopularCategory $popularCategory)
    {
        return view("pages.$this->route.show", [
            'object' => $popularCategory,
            'route' => $this->route
        ]);
    }

    public function edit(PopularCategory $popularCategory, PopularCategoryRepository $repository)
    {
        return view("pages.$this->route.edit", [
            'object' => $popularCategory,
            'hierarchies' => $repository->getAvailableOptions($popularCategory->hierarchy_id),
            'route' => $this->route
         ]);
    }

    public function update(UpdatePopularCategoryRequest $request, PopularCategory $popularCategory)
    {
        try {
            $popularCategory->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(PopularCategory $popularCategory, Request $request)
    {
        try {
            $popularCategory->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function updateSequence(Request $request)
    {
        foreach($request->sequence as $sequence) {
            PopularCategory::query()->whereKey($sequence['id'])->update([
                'sequence' => $sequence['sequence'],
            ]);
        }

        return response()->json(['message' => 'success']);
    }
}
