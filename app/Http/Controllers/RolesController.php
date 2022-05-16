<?php

namespace App\Http\Controllers;

use App\Models\Menurole;
use App\Models\RoleHierarchy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
            ->leftJoin('role_hierarchy', 'roles.id', '=', 'role_hierarchy.role_id')
            ->select('roles.*', 'role_hierarchy.hierarchy')
            ->orderBy('hierarchy', 'asc')
            ->get();

        return view('pages.roles.index', array(
            'roles' => $roles,
        ));
    }

    public function moveUp(Request $request)
    {
        $element = RoleHierarchy::where('role_id', '=', $request->input('id'))->first();
        $switchElement = RoleHierarchy::where('hierarchy', '<', $element->hierarchy)
            ->orderBy('hierarchy', 'desc')->first();
        if (!empty($switchElement)) {
            $temp = $element->hierarchy;
            $element->hierarchy = $switchElement->hierarchy;
            $switchElement->hierarchy = $temp;
            $element->save();
            $switchElement->save();
        }
        return redirect()->route('roles.index');
    }

    public function moveDown(Request $request)
    {
        $element = RoleHierarchy::where('role_id', '=', $request->input('id'))->first();
        $switchElement = RoleHierarchy::where('hierarchy', '>', $element->hierarchy)
            ->orderBy('hierarchy', 'asc')->first();
        if (!empty($switchElement)) {
            $temp = $element->hierarchy;
            $element->hierarchy = $switchElement->hierarchy;
            $switchElement->hierarchy = $temp;
            $element->save();
            $switchElement->save();
        }
        return redirect()->route('roles.index');
    }

    public function create()
    {
        return view('pages.roles.create');
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();
        $hierarchy = RoleHierarchy::select('hierarchy')
            ->orderBy('hierarchy', 'desc')->first();
        if (empty($hierarchy)) {
            $hierarchy = 0;
        } else {
            $hierarchy = $hierarchy['hierarchy'];
        }
        $hierarchy = ((integer)$hierarchy) + 1;
        $roleHierarchy = new RoleHierarchy();
        $roleHierarchy->role_id = $role->id;
        $roleHierarchy->hierarchy = $hierarchy;
        $roleHierarchy->save();
        $request->session()->flash('message', 'Successfully created role');
        return redirect()->route('roles.create');
    }

    public function edit($id)
    {
        return view('pages.roles.edit', array(
            'role' => Role::where('id', '=', $id)->first()
        ));
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('id', '=', $id)->first();
        $role->name = $request->input('name');
        $role->save();
        $request->session()->flash('message', 'Successfully updated role');
        return redirect()->route('roles.edit', $id);
    }

    public function destroy($id, Request $request)
    {
        $role = Role::where('id', '=', $id)->first();
        $roleHierarchy = RoleHierarchy::where('role_id', '=', $id)->first();
        $menuRole = Menurole::where('role_name', '=', $role->name)->first();
        if (!empty($menuRole)) {
            $request->session()->flash('message', "Can't delete. Role has assigned one or more menu elements.");
            $request->session()->flash('back', 'roles.index');
            return view('pages.shared.universal-info');
        } else {
            $role->delete();
            $roleHierarchy->delete();
            $request->session()->flash('message', "Successfully deleted role");
            $request->session()->flash('back', 'roles.index');
            return view('pages.shared.universal-info');
        }
    }
}
