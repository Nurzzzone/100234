<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HasFlashMessage;
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

    public function index()
    {
        return view("pages.{$this->route}.index",
        [
            'objects' => (self::MODEL)::paginate(10),
            'columns' => self::COLUMNS,
            'route' => $this->route,
        ]);
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
