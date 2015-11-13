<?php

namespace App\Http\Controllers\Admin;

use App\Swimming_ce_rules;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\SwimmingCeRulesFormRequest;

class SwimmingCeRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $swimming_ce_rules = DB::table('swimming_ce_rules')->orderBy('age_group', 'asc')->paginate(10);
        return view('backend.swimming_ce_rules.index', compact('swimming_ce_rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $swimming_ce_rule = Swimming_ce_rules::findOrFail($id);
        return view('backend.swimming_ce_rules.edit', compact('swimming_ce_rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, SwimmingCeRulesFormRequest $request)
    {
        $swimming_ce_rule = Swimming_ce_rules::findOrFail($id);
        $swimming_ce_rule->update($request->all());
        return redirect('/admin/swimming_ce_rules')->with('status', 'Szabály módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
