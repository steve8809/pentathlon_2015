<?php

namespace App\Http\Controllers\Admin;

use App\Swimming_ce_rule;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\SwimmingCeRulesFormRequest;

class SwimmingCeRulesController extends Controller
{

    public function index()
    {
        $swimming_ce_rules = DB::table('swimming_ce_rules')->orderBy('age_group', 'asc')->paginate(10);
        return view('backend.swimming_ce_rules.index', compact('swimming_ce_rules'));
    }

    public function edit($id)
    {
        $swimming_ce_rule = Swimming_ce_rule::findOrFail($id);
        return view('backend.swimming_ce_rules.edit', compact('swimming_ce_rule'));
    }

    public function update($id, SwimmingCeRulesFormRequest $request)
    {
        $swimming_ce_rule = Swimming_ce_rule::findOrFail($id);
        $swimming_ce_rule->update($request->all());
        return redirect('/admin/swimming_ce_rules')->with('status', 'Szabály módosítva');
    }

}
