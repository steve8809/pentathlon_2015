<?php

namespace App\Http\Controllers\Admin;

use App\Age_group;
use App\Competition;
use App\Fencing_rule;
use Illuminate\Http\Request;
use App\Competitor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competitiongroup;
use DB;
use App\Http\Requests\CompetitiongroupFormRequest;
use App\Result;
use App\Horse;
use App\Fencing_result;
use App\Http\Requests\SwimmingSaveFormRequest;
use App\Http\Requests\RidingSaveFormRequest;
use App\Http\Requests\CeSaveFormRequest;
use App\Http\Requests\EntryCloseFormRequest;

class CompetitiongroupsController extends Controller
{
    public function total_fencing_points($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $fencing_rule = Fencing_rule::where('bouts', '=', $competitiongroup->fencing_bouts)->firstOrFail();
        $fencing_250 = $fencing_rule->bouts_250;
        $fencing_victory_points = $fencing_rule->victory_points;
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $fencing_results = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor1_id', '=', $comp->competitor->id)->orWhere('competitor2_id', '=', $comp->competitor->id)->get();
            $temp = 0;

            foreach($fencing_results as $fence) {

                if ($fence->competitor1_id == $comp->competitor->id) {
                    $temp += $fence->competitor1_bouts;
                }
                if ($fence->competitor2_id == $comp->competitor_id) {
                    $temp += $fence->competitor2_bouts;
                }

            }
            $comp->fencing_win = $temp;
            $comp->fencing_lose = $comp->competitiongroup->fencing_bouts - $temp;
            if ($temp == 0) {
                $comp->fencing_points = 0;
            }
            else {
                $comp->fencing_points = 250 + ($comp->fencing_win - $fencing_250) * $fencing_victory_points;
            }

            $comp->save();
        }

        //Vívás sorrend kialakítása
        $fencing_order = Result::where('competitiongroup_id', '=', $id)->orderBy('fencing_points', 'desc')->get();
        $i = 0;
        foreach($fencing_order as $fence) {
            $i++;
            $fence->fencing_order = $i;
            $fence->save();
        }
    }

    public function total_points($id)
    {
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->total_points = $result->fencing_points + $result->swimming_points + $result->riding_points + $result->ce_points;
            $result->save();
        }

    }

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

        //Versenyzők a listába
        $competitors = Competitor::where('sex', '=', $competitiongroup->sex)->lists('full_name', 'id');
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

    public function entry_save(Request $request, $id)
    {
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

    public function entry_close(EntryCloseFormRequest $request, $id)
    {
        //Nevezés lezárása
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
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

    public function swimming($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        //Versenyzők és időeredményeik tárolása
        $competitor_in = [];
        $competitor_swimming = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_swimming[$comp->competitor->id] = $comp->swimming_time;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.swimming', compact('competitiongroup', 'competitor_in', 'competitor_swimming'));

    }

    public function swimming_save(SwimmingSaveFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $swimming_250 = DB::table('swimming_ce_rules')->select('swimming_time')->where('age_group','=',$competitiongroup->age_group)->where('type','=','Egyéni')->get();

        //"Időeredmény 250 ponthoz" átalakítása másodpercekké
        $str_time = $swimming_250[0]->swimming_time;
        $time_array = explode(':', $str_time);
        $minutes = $time_array[0];
        $seconds = $time_array[1];
        $swimming_250_seconds = $minutes * 60 + $seconds;

        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->swimming_time = $request->swimming[$comp->competitor->id];
            $str_time =  $request->swimming[$comp->competitor->id];

            if($str_time != "") {
                //Időeredmény átalakítása másodpercekké, úszó pontszám kiszámítása
                $time_array = explode(':', $str_time);
                $minutes = $time_array[0];
                $seconds = $time_array[1];
                $x = $minutes * 60 + $seconds;
                $swimming_points = floor(($swimming_250_seconds - $x)/(1/3));
                $result->swimming_points = 250 + $swimming_points;
            }

            $result->save();
        }

        //Úszó sorrend kialakítása
        $swimming_order = Result::where('competitiongroup_id', '=', $id)->where('swimming_time','!=','')->orderBy('swimming_time', 'asc')->get();
        $i = 0;
        foreach($swimming_order as $swim) {
            $i++;
            $swim->swimming_order = $i;
            $swim->save();
        }

        $this->total_points($id);
        return redirect('admin/competitiongroups/'.$id.'/swimming')->with('status', 'Eredmények mentve');
    }

    public function riding($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $horses = Horse::orderBy('name','asc')->lists('name', 'name')->all();

        $competitor_in = [];
        $competitor_riding = [];
        $competitor_horse = [];

        //Versenyzők neve, lovas pontszáma, lova
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_riding[$comp->competitor->id] = $comp->riding_points;
            $competitor_horse[$comp->competitor->id] = $comp->riding_horse;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.riding', compact('competitiongroup', 'competitor_in', 'competitor_riding', 'horses', 'competitor_horse'));
    }

    public function riding_save($id, RidingSaveFormRequest $request)
    {
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        //Versenyző lovas pontjainak ill. lovának mentése
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->riding_points = $request->riding[$comp->competitor->id];
            $result->riding_horse = $request->riding_horse[$comp->competitor->id];
            $result->save();
        }

        //Lovas sorrend kialakítása
        $riding_order = Result::where('competitiongroup_id', '=', $id)->where('riding_points','!=',0)->orderBy('riding_points', 'desc')->get();
        $i = 0;
        foreach($riding_order as $ride) {
            $i++;
            $ride->riding_order = $i;
            $ride->save();
        }

        $this->total_points($id);
        return redirect('admin/competitiongroups/'.$id.'/riding')->with('status', 'Eredmények mentve');
    }

    public function ce($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        //Versenyzők és kombinált időeredményeik tárolása
        $competitor_in = [];
        $competitor_ce = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_ce[$comp->competitor->id] = $comp->ce_time;
        }
        natsort($competitor_in);

        return view('backend.competitiongroups.ce', compact('competitiongroup', 'competitor_in', 'competitor_ce'));
    }

    public function ce_save(CeSaveFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $ce_500 = DB::table('swimming_ce_rules')->select('ce_time')->where('age_group','=',$competitiongroup->age_group)->where('type','=','Egyéni')->get();

        //"Időeredmény 500 ponthoz" átalakítása másodpercekké
        $str_time = $ce_500[0]->ce_time;
        $time_array = explode(':', $str_time);
        $minutes = $time_array[0];
        $seconds = $time_array[1];
        $ce_500_seconds = $minutes * 60 + $seconds;

        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->ce_time = $request->ce[$comp->competitor->id];
            $str_time = $request->ce[$comp->competitor->id];

            if($str_time != "") {
                //Időeredmény átalakítása másodpercekké, kombinált pontszám kiszámítása
                $time_array = explode(':', $str_time);
                $minutes = $time_array[0];
                $seconds = $time_array[1];
                $x = $minutes * 60 + $seconds;
                $ce_points = ceil(($ce_500_seconds - $x));
                $result->ce_points = 500 + $ce_points;
            }

            $result->save();
        }

        //Kombinált sorrend kialakítása
        $ce_order = Result::where('competitiongroup_id', '=', $id)->where('ce_time','!=','')->orderBy('ce_time', 'asc')->get();
        $i = 0;
        foreach($ce_order as $ce) {
            $i++;
            $ce->ce_order = $i;
            $ce->save();
        }

        $this->total_points($id);
        return redirect('admin/competitiongroups/'.$id.'/ce')->with('status', 'Eredmények mentve');
    }

    public function fencing(Request $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->orderBy('competitor_id')->get();

        //Nevezett versenyzők
        $competitor_in = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in);
        reset($competitor_in);
        $act_competitor = key($competitor_in);

        //Kiválasztott versenyző
        if ($request->competitor) {
            $act_competitor = $request->competitor;
        }

        //Ellenfél versenyzők
        $competitor_in_opp = [];
        foreach($competitor_list as $comp) {
            if ($act_competitor != $comp['competitor_id'])
            $competitor_in_opp[$comp->competitor->id] = $comp->competitor->full_name;
        }
        natsort($competitor_in_opp);

        //Vívó eredmények a versenyzőkhöz
        $fencing_results_list = Fencing_result::where('competitiongroup_id', '=', $id)->get();
        $fencing_results = [];
        foreach($fencing_results_list as $fence) {
            $fencing_results[$fence->competitor1_id.'_'.$fence->competitor2_id] = $fence->competitor1_bouts;
            $fencing_results[$fence->competitor2_id.'_'.$fence->competitor1_id] = $fence->competitor2_bouts;
        }

        return view('backend.competitiongroups.fencing', compact('competitiongroup', 'competitor_in', 'competitor_in_opp', 'competitor_list', 'act_competitor', 'fencing_results'));
    }

    public function fencing_save(Request $request, $id)
    {
        $act_competitor = $request->act_comp;
        $fencing_result = Fencing_result::where('competitiongroup_id', '=', $id)->get();

        //Vívó eredmények mentése
        foreach ($fencing_result as $res) {
            if ($res->competitor1_id == $act_competitor) {
                $res->competitor1_bouts = $request->fencing[$res->competitor1_id.'_'.$res->competitor2_id];
                $res->competitor2_bouts = $request->fencing[$res->competitor2_id.'_'.$res->competitor1_id];
                $res->save();
            }

            if ($res->competitor2_id == $act_competitor) {
                $res->competitor1_bouts = $request->fencing[$res->competitor1_id.'_'.$res->competitor2_id];
                $res->competitor2_bouts = $request->fencing[$res->competitor2_id.'_'.$res->competitor1_id];
                $res->save();
            }
        }

        $this->total_fencing_points($id);

        /*$competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $fencing_results = Fencing_result::where('competitiongroup_id', '=', $id)->get();
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            //dd($result);
            foreach ($fencing_results as $fence) {
                if ($fence->competitor1_id == $act_competitor) {
                    $result->fencing_win += $request->fencing[$res->competitor1_id.'_'.$res->competitor2_id];
                    dd($fence->competitor1_bouts);
                }
                if ($fence->competitor)
            }
        }*/

        /*$fencing_order = Result::where('competitiongroup_id', '=', $id)->where('fencing_points','!=',0)->orderBy('fencing_points', 'desc')->get();
        $i = 0;
        foreach($fencing_order as $fence) {
            $i++;
            $fence->fencing_order = $i;
            $fence->save();
        }*/

        $this->total_points($id);
        return redirect('admin/competitiongroups/'.$id.'/fencing?competitor='.$act_competitor.'')->with('status', 'Eredmények mentve');
    }


}
