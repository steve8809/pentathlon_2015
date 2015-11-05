<?php

namespace App\Http\Controllers\Admin;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = DB::table('competitions')->orderBy('start_date', 'desc')->paginate(10);
        return view('backend.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::lists('name', 'name')->all();
        $categories = Category::lists('category', 'category')->all();
        return view('backend.competitions.create', compact('countries', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitionFormRequest $request)
    {
        Competition::create($request->all());

        return redirect('admin/competitions')->with('status', 'Új verseny felvétele kész.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::lists('name','name')->all();
        $categories = Category::lists('category','category')->all();
        $competition = Competition::whereId($id)->firstOrFail();
        return view('backend.competitions.edit', compact('competition', 'countries', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $competition->update($request->all());
        return redirect('/admin/competitions')->with('status', 'Verseny adatai módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Competition::findOrFail($id)->delete();
        return redirect('/admin/competitions')->with('status', 'Verseny törölve');
    }
}
