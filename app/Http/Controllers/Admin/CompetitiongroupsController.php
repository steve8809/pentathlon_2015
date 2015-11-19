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
use App\Horse;
use App\Http\Requests\SwimmingSaveFormRequest;
use App\Http\Requests\RidingSaveFormRequest;

class CompetitiongroupsController extends Controller
{

    public function index()
    {
        $competitiongroups = Competitiongroup::orderBy('date', 'desc')->paginate(10);
        return view('backend.competitiongroups.index', compact('competitiongroups'));
    }

    public function create()
    {
        $competitions = Competition::lists('name', 'id')->all();
        $age_groups = Age_group::lists('age_group', 'age_group')->all();
        return view('backend.competitiongroups.create', compact('competitions', 'age_groups'));

    }

    public function store(CompetitiongroupFormRequest $request)
    {
        Competitiongroup::create($request->all());
        return redirect('admin/competitiongroups')->with('status', 'Új csoport felvétele kész.');
    }

    public function edit($id)
    {
        $competitions = Competition::lists('name', 'id')->all();
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

        $competitors = Competitor::where('sex', '=', $competitiongroup->sex)->lists('full_name', 'id');
        $already_in = Result::where('competitiongroup_id', '=', $id)->lists('competitor_id', 'competitor_id')->toArray();
        foreach ($already_in as $remove) {
            $competitors->forget($remove);
        }

        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

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
            $result = new Result;
            $result->competitor_id = $selected_cat;
            $result->competitiongroup_id = $id;
            $result->save();
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

    public function swimming($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        $competitor_in = [];
        $competitor_swimming = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_swimming[$comp->competitor->id] = $comp->swimming_time;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.swimming', compact('competitiongroup', 'competitor_in', 'competitor_swimming'));

    }

    public function swimming_save(SwimmingSaveFormRequest $request, $id) {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $swimming_250 = DB::table('swimming_ce_rules')->select('swimming_time')->where('age_group','=',$competitiongroup->age_group)->where('type','=','Egyéni')->get();

        $str_time = $swimming_250[0]->swimming_time;
        $time_array = explode(':', $str_time);
        $hours = $time_array[0];
        $minutes = $time_array[1];
        $seconds = $time_array[2];
        $swimming_250_seconds = $hours * 3600 + $minutes * 60 + $seconds;

        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->swimming_time = $request->swimming[$comp->competitor->id];
            $str_time = $result->swimming_time = $request->swimming[$comp->competitor->id];

            if($str_time != "") {
                $time_array = explode(':', $str_time);
                $hours = $time_array[0];
                $minutes = $time_array[1];
                $seconds = $time_array[2];
                $x = $hours * 3600 + $minutes * 60 + $seconds;
                $swimming_points = floor(($swimming_250_seconds - $x)/(1/3));
                $result->swimming_points = 250 + $swimming_points;
            }

            $result->save();
        }

        $swimming_order = Result::where('competitiongroup_id', '=', $id)->where('swimming_time','!=','')->orderBy('swimming_time', 'asc')->get();
        $i = 0;
        foreach($swimming_order as $swim) {
            $i++;
            $swim->swimming_order = $i;
            $swim->save();
        }

        return redirect('admin/competitiongroups/'.$id.'/swimming')->with('status', 'Eredmények mentve');

    }

    public function riding($id) {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $horses = Horse::orderBy('name','asc')->lists('name', 'name')->all();

        $competitor_in = [];
        $competitor_riding = [];
        $competitor_horse = [];

        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_riding[$comp->competitor->id] = $comp->riding_points;
            $competitor_horse[$comp->competitor->id] = $comp->riding_horse;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.riding', compact('competitiongroup', 'competitor_in', 'competitor_riding', 'horses', 'competitor_horse'));
    }

    public function riding_save($id, RidingSaveFormRequest $request) {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->riding_points = $request->riding[$comp->competitor->id];
            $result->riding_horse = $request->riding_horse[$comp->competitor->id];
            $result->save();
        }

        $riding_order = Result::where('competitiongroup_id', '=', $id)->where('riding_points','!=',0)->orderBy('riding_points', 'desc')->get();
        $i = 0;
        foreach($riding_order as $ride) {
            $i++;
            $ride->riding_order = $i;
            $ride->save();
        }

        return redirect('admin/competitiongroups/'.$id.'/riding')->with('status', 'Eredmények mentve');
    }
}
