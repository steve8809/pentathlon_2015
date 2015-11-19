<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->orderBy('name', 'asc')->paginate(10);
        return view('backend.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles->lists('id')->toArray();
        return view('backend.users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function update($id, UserFormRequest $request)
    {
        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != "") {
            $user->password = Hash::make($password);
        }
        $user->save();
        $user->saveRoles($request->get('role'));
        return redirect('/admin/users')->with('status', 'A felhasználó adatai módosítva!');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/admin/users');
    }
}
