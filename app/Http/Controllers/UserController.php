<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\View\EntityColumns\UserTableConfig;
use App\Traits\HasFlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = User::class;
    protected const COLUMNS = ['id' => 'GUID', 'fio' => 'FIO', 'email' => 'email', 'phone' => 'phone'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'user';
        View::share('page_title', 'Пользователи');
    }

    public function index(Request $request, UserTableConfig $tableConfig)
    {
        if (! $request->ajax()) {
            return view("pages.{$this->route}.index",
                [
                    'objects' => (self::MODEL)::paginate(request('perPage', 10)),
                    'tableConfig' => $tableConfig,
                    'route' => $this->route,
                ]);
        }

        return User::query()
            ->when($request->searchKeyword, function($query) use($request) {
                $query
                    ->orWhere('GUID', 'LIKE', "%$request->searchKeyword%")
                    ->orWhere('FIO', 'LIKE', "%$request->searchKeyword%")
                    ->orWhere('phone', 'LIKE', "%$request->searchKeyword%")
                    ->orWhere('email', 'LIKE', "%$request->searchKeyword%");
            })
            ->paginate(request('perPage', 10));

    }

    public function show(User $user)
    {
        $user->load('roles', 'permissions');

        return view("pages.{$this->route}.show", [
            'object' => $user,
            'route' => $this->route
        ]);
    }
}
