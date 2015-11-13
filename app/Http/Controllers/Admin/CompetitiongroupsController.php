<?php

namespace App\Http\Controllers\Admin;

use App\Age_group;
use App\Competition;
use Illuminate\Http\Request;
use App\Competitor;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competitiongroup;
use DB;
use App\Http\Requests\CompetitiongroupFormRequest;
use App\Results;


class CompetitiongroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitiongroups = DB::table('competitiongroups')->orderBy('date', 'desc')->paginate(10);
        return view('backend.competitiongroups.index', compact('competitiongroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $competitions = Competition::lists('name', 'name')->all();
        $age_groups = Age_group::lists('age_group', 'age_group')->all();
        return view('backend.competitiongroups.create', compact('competitions', 'age_groups'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitiongroupFormRequest $request)
    {
        Competitiongroup::create($request->all());
        return redirect('admin/competitiongroups')->with('status', 'Új csoport felvétele kész.');
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
        $competitions = Competition::lists('name', 'name')->all();
        $age_groups = Age_group::lists('age_group', 'age_group')->all();
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        return view('backend.competitiongroups.edit', compact('competitiongroup', 'competitions', 'age_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompetitiongroupFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::findOrFail($id);
        $competitiongroup->update($request->all());
        return redirect('/admin/competitiongroups')->with('status', 'Csoport adatai módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Competitiongroup::findOrFail($id)->delete();
        return redirect('/admin/competitiongroups')->with('status', 'Csoport törölve');
    }

    public function entry($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();

        $competitors = Competitor::where('sex', '=', $competitiongroup->sex)->lists('full_name', 'id');
        $already_in = Results::where('competitiongroup_id', '=', $id)->lists('competitor_id', 'competitor_id')->toArray();
        foreach ($already_in as $remove) {
            $competitors->forget($remove);
        }

        $competitor_list = Results::where('competitiongroup_id', '=', $id)->get();

        $competitor_in = [];
        foreach ($competitor_list as $comp) {
            //var_dump($comp->competitor->full_name);
            $competitor_in[$comp->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.entry', compact('competitiongroup', 'competitors', 'competitor_list', 'competitor_in'));
    }

    public function entry_save(Request $request, $id)
    {
        //$competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        foreach ($request->competitors as $selected_cat) {
            $result = new Results;
            $result->competitor_id = $selected_cat;
            $result->competitiongroup_id = $id;
            $result->save();
        }
        return redirect('/admin/competitiongroups/'.$id.'/entry')->with('status', 'Nevezés leadva');
    }

    public function destroy_entry($id)
    {
        $entry = Results::findOrFail($id);
        $del_id = $entry->competitiongroup_id;
        $entry->delete();
        return redirect('admin/competitiongroups/'.$del_id.'/entry')->with('status', 'Nevezés törölve');
    }
}
