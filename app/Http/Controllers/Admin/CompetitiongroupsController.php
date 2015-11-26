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
use App\Result;
use App\Fencing_result;
use App\Http\Requests\EntryCloseFormRequest;
use App\Http\Requests\EntrySaveFormRequest;

class CompetitiongroupsController extends Controller
{

    public function index()
    {
        $competitiongroups = Competitiongroup::orderBy('date', 'desc')->paginate(10);
        $competitiongroup_in_entry = Competitiongroup::where('entry_closed', '=', 0)->get();

        $in_entry = [];
        foreach($competitiongroup_in_entry as $comp) {
            $already_in = Result::where('competitiongroup_id', '=', $comp->id)->first();
            if ($already_in) {
                $in_entry[] = $already_in->competitiongroup_id;
            }
        }

        return view('backend.competitiongroups.index', compact('competitiongroups', 'in_entry'));
    }

    public function create()
    {
        $competitions = Competition::all()->lists('name_town_date_category', 'id')->all();
        $age_groups = Age_group::lists('age_group', 'age_group')->all();
        return view('backend.competitiongroups.create', compact('competitions', 'age_groups'));
    }

    public function store(CompetitiongroupFormRequest $request)
    {
        Competitiongroup::create($request->all());

        $in_competition = $request->competition_id;
        $competition = Competition::where('id', '=', $in_competition)->firstOrFail();
        $competition->in_competition = 1;
        $competition->save();

        return redirect('admin/competitiongroups')->with('status', 'Új csoport felvétele kész.');
    }

    public function edit($id)
    {
        $competitions = Competition::all()->lists('name_town_date_category', 'id')->all();
        $age_groups = Age_group::lists('age_group', 'age_group')->all();
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        return view('backend.competitiongroups.edit', compact('competitiongroup', 'competitions', 'age_groups'));
    }

    public function update(CompetitiongroupFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::findOrFail($id);
        $competitiongroup->update($request->all());
        return redirect('/admin/competitiongroups')->with('status', 'Csoport adatai módosítva');
    }

    public function destroy($id)
    {
        Competitiongroup::findOrFail($id)->delete();
        return redirect('/admin/competitiongroups')->with('status', 'Csoport törölve');
    }

    public function entry($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();

        //Versenyzők a listába
        $competitors = Competitor::where('sex', '=', $competitiongroup->sex)->get()->lists('full_name_birthday', 'id');
        $already_in = Result::where('competitiongroup_id', '=', $id)->lists('competitor_id', 'competitor_id')->toArray();
        foreach ($already_in as $remove) {
            $competitors->forget($remove);
        }

        //Benevezett versenyzők
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $competitor_in = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.entry', compact('competitiongroup', 'competitors', 'competitor_list', 'competitor_in'));
    }

    public function entry_save(EntrySaveFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();

        foreach ($request->competitors as $selected_cat) {
            $result = new Result;
            $result->competitor_id = $selected_cat;
            $result->competitiongroup_id = $id;
            $result->sex = $competitiongroup->sex;
            $result->age_group = $competitiongroup->age_group;
            $result->save();

            $competitor = Competitor::where('id', '=', $selected_cat)->firstOrFail();
            $competitor->in_competition = 1;
            $competitor->save();
        }
        return redirect('/admin/competitiongroups/'.$id.'/entry')->with('status', 'Nevezés leadva');
    }

    public function destroy_entry($id)
    {
        $entry = Result::findOrFail($id);
        $del_id = $entry->competitiongroup_id;
        $entry->delete();
        return redirect('admin/competitiongroups/'.$del_id.'/entry')->with('status', 'Nevezés törölve');
    }

    public function entry_close(EntryCloseFormRequest $request, $id)
    {
        //Nevezés lezárása
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitiongroup->bouts_per_match = $request->get('bouts_per_match');
        $competitiongroup->fencing_bouts = $request->get('fencing_bouts');
        $competitiongroup->entry_closed = 1;
        $competitiongroup->save();

        //Benevezett versenyzők vívó mérkőzéseinek összeállítása
        $competitor_list = Result::select('competitor_id')->where('competitiongroup_id', '=', $id)->orderBy('competitor_id')->get()->toArray();
        $competitor_in = [];
        foreach($competitor_list as $comp) {
            $competitor_in[] = $comp['competitor_id'];
        }

        while (count($competitor_in) >= 2) {
            foreach ($competitor_in as $comp) {
                if ($competitor_in[0] != $comp) {
                    $fencing_result = new Fencing_result;
                    $fencing_result->competitiongroup_id = $id;
                    $fencing_result->competitor1_id = $competitor_in[0];
                    $fencing_result->competitor2_id = $comp;
                    $fencing_result->save();
                }
            }
            unset($competitor_in[0]);
            $competitor_in = array_values($competitor_in);
        }
        return redirect('admin/competitiongroups/')->with('status', 'Nevezés lezárva');
    }
}