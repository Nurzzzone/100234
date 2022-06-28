<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Traits\HasFile;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Requests\AboutUs\CreateAboutUsRequest;
use App\Http\Requests\AboutUs\UpdateAboutUsRequest;
use Illuminate\Support\Facades\View;

class AboutUsController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = AboutUs::class;
    protected const COLUMNS = ['title' => 'title', 'is_active' => 'is_active', 'image' => 'image'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'aboutUs';
        View::share('page_title', 'О Нас');
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

    public function store(CreateAboutUsRequest $request)
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

    public function show(AboutUs $aboutUs)
    {
        return view("pages.$this->route.show", [
            'object' => $aboutUs,
            'route' => $this->route
        ]);
    }

    public function edit(AboutUs $aboutUs)
    {
        return view("pages.$this->route.edit", [
            'object' => $aboutUs,
            'route' => $this->route
         ]);
    }

    public function update(UpdateAboutUsRequest $request, AboutUs $aboutUs)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $aboutUs->image, $this->route);
            $aboutUs->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(AboutUs $aboutUs, Request $request)
    {
        try {
            $this->deleteFile($aboutUs->image);

            $aboutUs->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }
}
