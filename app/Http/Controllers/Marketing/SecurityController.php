<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Security\CreateSecurityRequest;
use App\Http\Requests\Security\UpdateSecurityRequest;
use App\Models\StaticPages\Security;
use App\Traits\HasFlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SecurityController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Security::class;
    protected const COLUMNS = ['title' => 'title', 'is_active' => 'is_active'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'security';
        View::share('page_title', 'Безопасность');
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

    public function store(CreateSecurityRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function show(Security $security)
    {
        return view("pages.$this->route.show", [
            'object' => $security,
            'route' => $this->route
        ]);
    }

    public function edit(Security $security)
    {
        return view("pages.$this->route.edit", [
            'object' => $security,
            'route' => $this->route
        ]);
    }

    public function update(UpdateSecurityRequest $request, Security $security)
    {
        try {
            $security->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function destroy(Security $security, Request $request)
    {
        try {
            $security->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "$this->route.index");
    }

    public function updateSequence(Request $request)
    {
        foreach ($request->sequence as $sequence) {
            Security::query()->whereKey($sequence['id'])->update([
                'order' => $sequence['sequence'],
            ]);
        }

        return response()->json(['message' => 'success']);
    }
}
