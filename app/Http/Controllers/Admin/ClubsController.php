<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Club;
use App\Http\Requests\ClubFormRequest;
use App\Country;
use DB;

class ClubsController extends Controller
{

    public function index()
    {
        $clubs = DB::table('clubs')->orderBy('name','asc')->paginate(10);
        return view('backend.clubs.index', compact('clubs'));
    }

    public function create()
    {
        $countries = Country::orderBy('name', 'asc')->get()->lists('name','name')->all();
        return view('backend.clubs.create', compact('countries'));
    }

    public function store(ClubFormRequest $request)
    {
        Club::create($request->all());
        return redirect('admin/clubs')->with('status', 'Új klub felvétele kész.');
    }

    public function edit($id)
    {
        $countries = Country::orderBy('name', 'asc')->get()->lists('name','name')->all();
        $club = Club::whereId($id)->firstOrFail();
        return view('backend.clubs.edit', compact('club', 'countries'));
    }

    public function update(ClubFormRequest $request, $id)
    {
        $club = Club::findOrFail($id);
        $club->update($request->all());
        return redirect('/admin/clubs')->with('status', 'Klub adatai szerkesztve.');
    }


    public function destroy($id)
    {
        Club::findOrFail($id)->delete();
        return redirect('/admin/clubs')->with('status', 'Klub törölve');
    }
}
