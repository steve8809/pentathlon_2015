<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Club;
use App\Http\Requests\ClubFormRequest;
use App\Country;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::paginate(10);
        return view('backend.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::lists('name','name')->all();
        return view('backend.clubs.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClubFormRequest $request)
    {
        Club::create($request->all());

        return redirect('admin/clubs')->with('status', 'Új klub felvétele kész.');
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
        $club = Club::whereId($id)->firstOrFail();
        return view('backend.clubs.edit', compact('club', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClubFormRequest $request, $id)
    {
        $club = Club::findOrFail($id);
        $club->update($request->all());
        return redirect('/admin/clubs')->with('status', 'Klub adatai szerkesztve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Club::findOrFail($id)->delete();
        return redirect('/admin/clubs')->with('status', 'Klub törölve');
    }
}
