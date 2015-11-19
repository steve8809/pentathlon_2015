<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Http\Requests\RoleFormRequest;
use DB;

class RolesController extends Controller
{

    public function index()
    {
        $roles = DB::table('roles')->orderBy('name', 'asc')->paginate(10);
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('backend.roles.create');
    }

    public function store(RoleFormRequest $request)
    {
        Role::create($request->all());
        return redirect('/admin/roles')->with('status', 'Új jogosultsági beállítás elkészítve.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.edit', compact('role'));
    }

    public function update($id, RoleFormRequest $request)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return redirect('/admin/roles')->with('status', 'Jogosultság módosítva');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect('/admin/roles')->with('status', 'Jogosultság törölve.');
    }
}
