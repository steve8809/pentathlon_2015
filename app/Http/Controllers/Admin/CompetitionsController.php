<?php

namespace App\Http\Controllers\Admin;

use App\Competitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionFormRequest;
use App\Competition;
use DB;
use App\Category;
use App\Country;

class CompetitionsController extends Controller
{

    public function index()
    {
        $competitions = Competition::orderBy('date', 'desc')->paginate(10);
        return view('backend.competitions.index', compact('competitions'));
    }

    public function create()
    {
        $countries = Country::lists('name', 'id')->all();
        $categories = Category::lists('category', 'category')->all();
        return view('backend.competitions.create', compact('countries', 'categories'));
    }

    public function store(CompetitionFormRequest $request)
    {
        Competition::create($request->all());
        return redirect('admin/competitions')->with('status', 'Új verseny felvétele kész.');
    }

    public function edit($id)
    {
        $countries = Country::lists('name','id')->all();
        $categories = Category::lists('category','category')->all();
        $competition = Competition::whereId($id)->firstOrFail();
        return view('backend.competitions.edit', compact('competition', 'countries', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $competition->update($request->all());
        return redirect('/admin/competitions')->with('status', 'Verseny adatai módosítva');
    }

    public function destroy($id)
    {
        Competition::findOrFail($id)->delete();
        return redirect('/admin/competitions')->with('status', 'Verseny törölve');
    }
}
