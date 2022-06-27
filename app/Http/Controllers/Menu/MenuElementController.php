<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Menus\GetSidebarMenu;
use App\Models\Auth\Role;
use App\Models\Menulist;
use App\Models\Menurole;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuElementController extends Controller
{
    public function index()
    {
        $menuId = Menulist::first()->id;
        $getSidebarMenu = new GetSidebarMenu();

        return view('pages.menu.index', array(
            'menulist' => Menulist::all(),
            'role' => 'Администратор',
            'roles' => Role::query()->orderBy('name')->pluck('name', 'id')->prepend(null),
            'menuToEdit' => $getSidebarMenu->getAll($menuId),
            'menuElements' => Menus::query()->where('menu_id', $menuId)->orderBy('sequence')->get(),
            'thisMenu' => $menuId,
            'slugs' => collect(Menus::MENU_ELEMENT_TYPES),
            'parents' => Menus::dropdown()->pluck('name', 'id')->prepend('-', '_'),
        ));
    }

    public function delete(Menus $menuElement)
    {
        $menuElement->delete();

        Menurole::where('menus_id', $menuElement->getKey())->delete();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $data = $this->validationData($request);
        $data['sequence'] = Menus::query()->latest('sequence')->first()->sequence + 1;
        $data['parent_id'] = $data['parent_id'] !== '_' ? $data['parent_id'] : null;
        $data['menu_id'] = 1;

        $menuElement = Menus::query()->create($data);

        Menurole::query()->create([
            'role_name' => 'Администратор',
            'menus_id' => $menuElement->id,
        ]);

        return redirect()->back();
    }

    public function show(Menus $menuElement)
    {
        return $menuElement;
    }

    public function update(Menus $menuElement, Request $request)
    {
        $data = $this->validationData($request);

        $data['parent_id'] = $data['parent_id'] !== '_' ? $data['parent_id'] : null;
        $data['sequence'] = $data['sequence'] ?? Menus::query()->latest('sequence')->first()->sequence + 1;
        unset($data['sequence']);

        $menuElement->update($data);

        return redirect()->back();
    }

    public function sequence(Request $request)
    {
//        $current_sequence = Menus::query()->orderBy('sequence')->get(['id', 'parent_id', 'sequence']);
//
//        foreach($current_sequence as $sequence) {
//            if (is_null($sequence->parent_id)){
//                unset($sequence->parent_id);
//            }
//        }

//        $sequence = array_udiff($current_sequence->toArray(), $request->input('sequence'), function($a, $b) {
//            return $a['sequence'] <=> $b['sequence'];
//        });

        DB::transaction(function() use ($request) {
            foreach($request->input('sequence') as $element) {
                Menus::query()->where('id', $element['id'])->update($element);
            }
        });

        return response()->json(['message' => 'success']);
    }

    protected function validationData($request)
    {
        return $request->validate([
            'name' => ['required', 'string'],
            'href' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'parent_id' => ['nullable'],
            'icon' => ['nullable', 'string']
        ]);
    }
}
