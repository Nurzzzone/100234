<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Support\View\TableConfig\NewsTableConfig;
use App\Traits\HasFile;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Requests\News\CreateNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = News::class;
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'news';
        View::share('page_title', 'Новости');
    }

    public function index(NewsTableConfig $tableConfig)
    {
        return view("pages.index",
        [
            'objects' => (self::MODEL)::paginate(10),
            'tableConfig' => $tableConfig,
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

    public function store(CreateNewsRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->uploadFile($request['image'], $this->route . '\\');
            (self::MODEL)::query()->create($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(News $news)
    {
        return view("pages.$this->route.show", [
            'object' => $news,
            'route' => $this->route
        ]);
    }

    public function edit(News $news)
    {
        return view("pages.$this->route.edit", [
            'object' => $news,
            'route' => $this->route
         ]);
    }

    public function toggle(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());

        return response()->json(['message' => 'success']);
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'] ?? null, $news->image, $this->route);
            $news->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(News $news, Request $request)
    {
        try {
            $this->deleteFile($news->image);

            $news->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }
}
