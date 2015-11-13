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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitors = DB::table('competitors')->orderBy('last_name', 'desc')->paginate(10);
        return view('backend.competitors.index', compact('competitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::lists('name', 'name')->all();
        $clubs = Club::lists('name', 'name')->all();
        return view('backend.competitors.create', compact('countries', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitorFormRequest $request)
    {
        $competitor = new Competitor;
        $competitor->first_name = $request->get('first_name');
        $competitor->last_name = $request->get('last_name');
        $competitor->sex = $request->get('sex');
        $competitor->birthday = $request->get('birthday');
        $competitor->country = $request->get('country');
        $competitor->club = $request->get('club');
        $competitor->full_name = $request->get('last_name').' '.$request->get('first_name');
        $competitor->save();

        return redirect('admin/competitors')->with('status', 'Új versenyző felvétele kész.');
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
        $clubs = Club::lists('name','name')->all();
        $competitor = Competitor::whereId($id)->firstOrFail();
        return view('backend.competitors.edit', compact('competitor', 'countries', 'clubs'));
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
        $competitor = Competitor::findOrFail($id);
        $competitor->first_name = $request->get('first_name');
        $competitor->last_name = $request->get('last_name');
        $competitor->sex = $request->get('sex');
        $competitor->birthday = $request->get('birthday');
        $competitor->country = $request->get('country');
        $competitor->club = $request->get('club');
        $competitor->full_name = $request->get('last_name').' '.$request->get('first_name');
        $competitor->save();
        return redirect('/admin/competitors')->with('status', 'Versenyző adatai módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Competitor::findOrFail($id)->delete();
        return redirect('/admin/competitors')->with('status', 'Versenyző törölve');
    }
}
