<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Horse;
use App\Http\Requests\HorseFormRequest;
use DB;

class HorsesController extends Controller
{

    public function index()
    {
        $horses = DB::table('horses')->orderBy('name', 'asc')->paginate(10);
        return view('backend.horses.index', compact('horses'));
    }

    public function create()
    {
        return view('backend.horses.create');
    }

    public function store(HorseFormRequest $request)
    {
        Horse::create($request->all());
        return redirect('/admin/horses')->with('status', 'Új ló felvétele kész.');
    }

    public function edit($id)
    {
        $horse = Horse::whereId($id)->firstOrFail();
        return view('backend.horses.edit', compact('horse'));
    }

    public function update(HorseFormRequest $request, $id)
    {
        $horse = Horse::findOrFail($id);
        $horse->update($request->all());
        return redirect('/admin/horses')->with('status', 'Ló adatai szerkesztve.');
    }

    public function destroy($id)
    {
        Horse::findorFail($id)->delete();
        return redirect('/admin/horses')->with('status', 'Ló törölve.');
    }

}
