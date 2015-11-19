<?php

namespace App\Http\Controllers\Admin;

use App\Fencing_rules;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FencingRulesController extends Controller
{

    public function index()
    {
        $fencing_rules = DB::table('fencing_rules')->orderBy('bouts', 'desc')->paginate(10);
        return view('backend.fencing_rules.index', compact('fencing_rules'));
    }

    public function edit($id)
    {
        $fencing_rule = Fencing_rules::findOrFail($id);
        return view('backend.fencing_rules.edit', compact('fencing_rule'));
    }

    public function update(Request $request, $id)
    {
        $fencing_rule = Fencing_rules::findOrFail($id);
        $fencing_rule->update($request->all());
        return redirect('/admin/fencing_rules')->with('status', 'Pontozás módosítva');
    }
}
