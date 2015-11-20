<?php

namespace App\Http\Controllers\Admin;

use App\Fencing_rule;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\FencingRulesFormRequest;

class FencingRulesController extends Controller
{

    public function index()
    {
        $fencing_rules = DB::table('fencing_rules')->orderBy('bouts', 'desc')->paginate(10);
        return view('backend.fencing_rules.index', compact('fencing_rules'));
    }

    public function edit($id)
    {
        $fencing_rule = Fencing_rule::findOrFail($id);
        return view('backend.fencing_rules.edit', compact('fencing_rule'));
    }

    public function update(FencingRulesFormRequest $request, $id)
    {
        $fencing_rule = Fencing_rule::findOrFail($id);
        $fencing_rule->update($request->all());
        return redirect('/admin/fencing_rules')->with('status', 'Pontozás módosítva');
    }
}
