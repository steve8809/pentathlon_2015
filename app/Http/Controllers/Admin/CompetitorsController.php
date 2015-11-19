<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competitor;
use App\Http\Requests\CompetitorFormRequest;
use App\Country;
use App\Club;
use DB;

class CompetitorsController extends Controller
{

    public function index()
    {
        $competitors = Competitor::orderBy('last_name', 'desc')->paginate(10);
        return view('backend.competitors.index', compact('competitors'));
    }

    public function create()
    {
        $countries = Country::lists('name', 'id')->all();
        $clubs = Club::lists('name', 'name')->all();
        return view('backend.competitors.create', compact('countries', 'clubs'));
    }

    public function store(CompetitorFormRequest $request)
    {
        $competitor = new Competitor;
        $competitor->first_name = $request->get('first_name');
        $competitor->last_name = $request->get('last_name');
        $competitor->sex = $request->get('sex');
        $competitor->birthday = $request->get('birthday');
        $competitor->country_id = $request->get('country_id');
        $competitor->club = $request->get('club');
        $competitor->full_name = $request->get('last_name').' '.$request->get('first_name');
        $competitor->save();
        return redirect('admin/competitors')->with('status', 'Új versenyző felvétele kész.');
    }

    public function edit($id)
    {
        $countries = Country::lists('name','id')->all();
        $clubs = Club::lists('name','name')->all();
        $competitor = Competitor::whereId($id)->firstOrFail();
        return view('backend.competitors.edit', compact('competitor', 'countries', 'clubs'));
    }

    public function update(Request $request, $id)
    {
        $competitor = Competitor::findOrFail($id);
        $competitor->first_name = $request->get('first_name');
        $competitor->last_name = $request->get('last_name');
        $competitor->sex = $request->get('sex');
        $competitor->birthday = $request->get('birthday');
        $competitor->country_id = $request->get('country_id');
        $competitor->club = $request->get('club');
        $competitor->full_name = $request->get('last_name').' '.$request->get('first_name');
        $competitor->save();
        return redirect('/admin/competitors')->with('status', 'Versenyző adatai módosítva');
    }

    public function destroy($id)
    {
        Competitor::findOrFail($id)->delete();
        return redirect('/admin/competitors')->with('status', 'Versenyző törölve');
    }
}
