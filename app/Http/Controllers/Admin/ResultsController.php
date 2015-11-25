<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SwimmingSaveFormRequest;
use App\Http\Requests\RidingSaveFormRequest;
use App\Http\Requests\CeSaveFormRequest;
use App\Horse;
use App\Fencing_rule;
use App\Swimming_ce_rule;
use App\Competitiongroup;
use DB;
use App\Result;
use App\Fencing_result;

class ResultsController extends Controller
{
    public function total_fencing_points($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $fencing_rule = Fencing_rule::where('bouts', '=', $competitiongroup->fencing_bouts)->firstOrFail();
        $fencing_250 = $fencing_rule->bouts_250;
        $fencing_victory_points = $fencing_rule->victory_points;
        foreach ($competitor_list as $comp) {
            $fencing_results1 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor1_id', '=', $comp->competitor->id)->get();
            $fencing_results2 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor2_id', '=', $comp->competitor->id)->get();
            $temp_win = 0;
            $temp_lose = 0;

            foreach($fencing_results1 as $fence) {
                if ($fence->competitor1_id == $comp->competitor->id) {
                    $temp_win += $fence->competitor1_bouts;
                    $temp_lose += $fence->competitor2_bouts;
                }
            }

            foreach($fencing_results2 as $fence) {
                if ($fence->competitor2_id == $comp->competitor_id) {
                    $temp_win += $fence->competitor2_bouts;
                    $temp_lose += $fence->competitor1_bouts;
                }
            }

            $comp->fencing_win = $temp_win;
            $comp->fencing_lose = $temp_lose;
            if ($temp_win == 0) {
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

    public function swimming($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        $swimming_rule = Swimming_ce_rule::select('swimming_dist')->where('age_group','=', $competitiongroup->age_group)->where('type','Egyéni')->get();
        $swimming_dist = $swimming_rule[0];

        //Versenyzők és időeredményeik tárolása
        $competitor_in = [];
        $competitor_swimming = [];
        $competitor_swimming_points = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_swimming[$comp->competitor->id] = $comp->swimming_time;
            $competitor_swimming_points[$comp->competitor->id] = $comp->swimming_points;
        }
        natsort($competitor_in);

        return view('backend.results.swimming', compact('competitiongroup', 'competitor_in', 'competitor_swimming', 'swimming_dist', 'competitor_swimming_points'));

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
                if ($swimming_points < -250) {
                    $result->swimming_points = 0;
                }
                else {
                    $result->swimming_points = 250 + $swimming_points;
                }

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
        $horses = Horse::orderBy('name','asc')->lists('name', 'id')->all();

        $competitor_in = [];
        $competitor_riding = [];
        $competitor_horse = [];

        //Versenyzők neve, lovas pontszáma, lova
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_riding[$comp->competitor->id] = $comp->riding_points;
            if ($comp->horse != null){
                $competitor_horse[$comp->competitor->id] = $comp->horse->id;
            }
            else {
                $competitor_horse[$comp->competitor->id] = "";
            }
        }
        natsort($competitor_in);

        return view('backend.results.riding', compact('competitiongroup', 'competitor_in', 'competitor_riding', 'horses', 'competitor_horse'));
    }

    public function riding_save($id, RidingSaveFormRequest $request)
    {
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();

        //Versenyző lovas pontjainak ill. lovának mentése
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->riding_points = $request->riding[$comp->competitor->id];
            $result->horse_id = $request->horse_id[$comp->competitor->id];
            $result->save();

            $horse = Horse::where('id', '=', $request->horse_id[$comp->competitor->id])->firstOrFail();
            $horse->in_competition = 1;
            $horse->save();
        }



        //Lovas sorrend kialakítása
        $riding_order = Result::where('competitiongroup_id', '=', $id)->where('riding_points','!=',0)->WhereNotNull('horse_id')->orderBy('riding_points', 'desc')->get();
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
        $ce_rule = Swimming_ce_rule::select('ce_dist')->where('age_group','=', $competitiongroup->age_group)->where('type','Egyéni')->get();
        $ce_dist = $ce_rule[0];

        //Versenyzők és kombinált időeredményeik tárolása
        $competitor_in = [];
        $competitor_ce = [];
        $competitor_ce_points = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_ce[$comp->competitor->id] = $comp->ce_time;
            $competitor_ce_points[$comp->competitor->id] = $comp->ce_points;
        }
        natsort($competitor_in);

        return view('backend.results.ce', compact('competitiongroup', 'competitor_in', 'competitor_ce', 'competitor_ce_points', 'ce_dist'));
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
                if ($ce_points < -500) {
                    $result->ce_points = 0;
                }
                else {
                    $result->ce_points = 500 + $ce_points;
                }

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
        $bouts_per_match = $competitiongroup->bouts_per_match;

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

        return view('backend.results.fencing', compact('competitiongroup', 'competitor_in', 'competitor_in_opp', 'competitor_list', 'act_competitor', 'fencing_results', 'bouts_per_match'));
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

        $this->total_points($id);
        return redirect('admin/competitiongroups/'.$id.'/fencing?competitor='.$act_competitor.'')->with('status', 'Eredmények mentve');
    }

}
