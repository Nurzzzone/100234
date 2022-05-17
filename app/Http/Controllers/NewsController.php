<?php

namespace App\Http\Controllers;

use App\Models\News;
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
    protected const COLUMNS = ['title' => 'title', 'description' => 'description', 'is_active' => 'is_active', 'image' => 'image'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'news';
        View::share('page_title', 'Новости');
    }

    public function index()
    {
        return view("pages.$this->route.index",
        [
            'objects' => (self::MODEL)::paginate(10),
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

    public function update(UpdateNewsRequest $request, News $news)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $news->image, $this->route);
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
