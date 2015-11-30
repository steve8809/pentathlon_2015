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
use App\Http\Requests\TeamsEntrySaveFormRequest;
use App\Results_team;

class CompetitiongroupsController extends Controller
{

    public function index()
    {
        $competitiongroups = Competitiongroup::orderBy('date', 'desc')->paginate(6);
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
        $in_competition = $request->competition_id;

        $competitiongroup = new Competitiongroup();
        $competitiongroup->competition_id = $in_competition;
        $competitiongroup->date = $request->date;
        $competitiongroup->type = $request->type;
        $competitiongroup->sex = $request->sex;
        $competitiongroup->age_group = $request->age_group;
        $competitiongroup->name = $request->age_group.' '.$request->sex.' '.$request->type;
        $competitiongroup->save();

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

        $in_competition = $request->competition_id;

        $competitiongroup->competition_id = $request->competition_id;
        $competitiongroup->date = $request->date;
        $competitiongroup->type = $request->type;
        $competitiongroup->sex = $request->sex;
        $competitiongroup->age_group = $request->age_group;
        $competitiongroup->name = $request->age_group.' '.$request->sex.' '.$request->type;
        $competitiongroup->save();

        $competition = Competition::where('id', '=', $in_competition)->firstOrFail();
        $competition->in_competition = 1;
        $competition->save();

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
        $act_competitiongroup = $competitiongroup->id;

        //Versenyzők a listába
        $competitors = Competitor::where('sex', '=', $competitiongroup->sex)->orderBy('full_name')->get()->lists('full_name_birthday', 'id');
        $already_in = Result::where('competitiongroup_id', '=', $id)->lists('competitor_id', 'competitor_id')->toArray();
        foreach ($already_in as $remove) {
            $competitors->forget($remove);
        }

        //Benevezett versenyzők
        $competitor_list = Result::select('results.*')->where('competitiongroup_id', '=', $id)->join('competitors', 'results.competitor_id', '=', 'competitors.id')->orderBy('full_name', 'asc')->get();
        $competitor_in = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in);
        $comp_count = count($competitor_in);

        //Benevezett versenyzők csapatba
        $already_in1 = Results_team::select('competitor1_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor1_id', 'competitor1_id');
        $already_in2 = Results_team::select('competitor2_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor2_id', 'competitor2_id');
        $already_in3 = Results_team::select('competitor3_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor3_id', 'competitor3_id');

        $in_team = [];

        foreach ($already_in1 as $add) {
            $in_team[] = $add;
        }
        foreach ($already_in2 as $add) {
            $in_team[] = $add;
        }
        foreach ($already_in3 as $add) {
            $in_team[] = $add;
        }

        return view('backend.competitiongroups.entry', compact('competitiongroup', 'competitors', 'competitor_list', 'competitor_in', 'comp_count', 'in_team', 'act_competitiongroup'));
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

    public function teams_entry($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();

        //Versenyzők a listába
        $result_list = Result::where('competitiongroup_id', '=',$id)->get()->lists('competitor_id', 'competitor_id');
        $already_in1 = Results_team::select('competitor1_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor1_id', 'competitor1_id');
        $already_in2 = Results_team::select('competitor2_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor2_id', 'competitor2_id');
        $already_in3 = Results_team::select('competitor3_id')->where('competitiongroup_id', '=', $id)->get()->lists('competitor3_id', 'competitor3_id');

        foreach ($already_in1 as $remove) {
            $result_list->forget($remove);
        }
        foreach ($already_in2 as $remove) {
            $result_list->forget($remove);
        }
        foreach ($already_in3 as $remove) {
            $result_list->forget($remove);
        }

        $competitors = [];
        foreach ($result_list as $comp) {
            $temp_comp = Competitor::whereId($comp)->first();
            $competitors[$comp] = $temp_comp->full_name_birthday;
        }
        natsort($competitors);

        //Benevezett versenyzők
        $competitor_list = Result::select('results.*')->where('competitiongroup_id', '=', $id)->join('competitors', 'results.competitor_id', '=', 'competitors.id')->orderBy('full_name', 'asc')->get();
        $competitor_in = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in);
        $comp_count = count($competitor_in);

        //Benevezett csapatok
        $team_list = Results_team::where('competitiongroup_id', '=', $id)->orderBy('name')->get();
        $team_in = [];
        foreach ($team_list as $team) {
            $team_in[$team->id] = $team->name;
        }
        natsort($team_in);
        $team_count = count($team_in);

        return view('backend.competitiongroups.teams_entry', compact('competitiongroup', 'competitors', 'team_in', 'team_list', 'team_count', 'competitor_in', 'competitor_list', 'comp_count'));
    }

    public function teams_entry_save(TeamsEntrySaveFormRequest $request, $id)
    {
        $competitors = $request->competitors;
        $team = new Results_team();
        $team->competitiongroup_id = $id;
        $team->competitor1_id = $competitors[0];
        $team->competitor2_id = $competitors[1];
        $team->competitor3_id = $competitors[2];
        $team->name = $request->team_name;
        $team->save();

        return redirect('/admin/competitiongroups/'.$id.'/entry/teams_entry')->with('status', 'Nevezés leadva');
    }

    public function destroy_team_entry($id)
    {
        $team = Results_team::findOrFail($id);
        $del_id = $team->competitiongroup_id;
        $team->delete();
        return redirect('admin/competitiongroups/'.$del_id.'/entry/teams_entry')->with('status', 'Nevezés törölve');
    }

    public function entry_close(EntryCloseFormRequest $request, $id)
    {
        //Nevezés lezárása
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitiongroup->bouts_per_match = $request->get('bouts_per_match');
        $competitiongroup->fencing_bouts = $request->get('fencing_bouts');
        $competitiongroup->entry_closed = 1;
        $competitiongroup->riding_time_limit = $request->get('riding_time_limit');
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