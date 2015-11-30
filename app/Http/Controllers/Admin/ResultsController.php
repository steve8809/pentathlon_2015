<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SwimmingSaveFormRequest;
use App\Http\Requests\RidingSaveFormRequest;
use App\Http\Requests\CeSaveFormRequest;
use App\Http\Requests\FencingSaveFormRequest;
use App\Horse;
use App\Fencing_rule;
use App\Swimming_ce_rule;
use App\Competitiongroup;
use DB;
use App\Result;
use App\Fencing_result;
use App\Results_team;

class ResultsController extends Controller
{
    //Úszó sorrend
    public function swimming_order($id)
    {
        $swimming_order = Result::where('competitiongroup_id', '=', $id)->where('swimming_time','!=','')
            ->where('swimming_status', '')->where('dsq_status', '=', 0)->orderBy('swimming_points', 'desc')->orderBy('swimming_time', 'asc')->get();
        $i = 0;
        foreach($swimming_order as $swim) {
            $i++;
            $swim->swimming_order = $i;
            $swim->save();
        }
    }

    //Kombinált sorrend
    public function ce_order($id)
    {
        $ce_order = Result::where('competitiongroup_id', '=', $id)->where('ce_time','!=','')
            ->where('ce_status', '')->where('dsq_status', 0)->orderBy('ce_points', 'desc')->orderBy('ce_time', 'asc')->get();
        $i = 0;
        foreach($ce_order as $ce) {
            $i++;
            $ce->ce_order = $i;
            $ce->save();
        }
    }

    //Lovaglás sorrend
    public function riding_order($id)
    {
        $riding_order = Result::where('competitiongroup_id', '=', $id)->WhereNotNull('horse_id')->
            where('riding_status', '')->where('dsq_status', 0)->orderBy('riding_points', 'desc')->orderBy('riding_time', 'asc')->get();
        $i = 0;
        foreach($riding_order as $ride) {
            $i++;
            $ride->riding_order = $i;
            $ride->save();
        }
    }

    //Vívás sorrend
    public function fencing_order($id)
    {
        $fencing_order = Result::where('competitiongroup_id', '=', $id)->where('fencing_status', '')->where('dsq_status', 0)->whereNotNull('fencing_win')->orderBy('fencing_points', 'desc')->get();
        $i = 0;
        foreach($fencing_order as $fence) {
            $i++;
            $fence->fencing_order = $i;
            $fence->save();
        }
        if($fencing_order->count() == 0) {
            $fencing_order = Result::where('competitiongroup_id', '=', $id)->get();
            foreach($fencing_order as $fence) {
                $fence->fencing_order = 0;
                $fence->save();
            }
        }
    }

    //Vívás pontszámok
    public function total_fencing_points($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('fencing_status', '')->where('dsq_status', 0)->get();
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

            if ($temp_win == 0 && $temp_lose == 0) {
                $comp->fencing_win = null;
                $comp->fencing_lose = null;
            }
            else {
                $comp->fencing_win = $temp_win;
                $comp->fencing_lose = $temp_lose;
            }

            if ($temp_win == 0) {
                $comp->fencing_points = 0 - $comp->penalty_points_fencing;
            }
            else {
                $comp->fencing_points = 250 + ($comp->fencing_win - $fencing_250) * $fencing_victory_points - $comp->penalty_points_fencing;
            }

            $comp->save();
        }

        //Vívás sorrend kialakítása
       $this->fencing_order($id);
    }

    //Össz pontszám kiszámítása
    public function total_points($id)
    {
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->get();
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            $result->total_points = $result->fencing_points + $result->swimming_points + $result->riding_points + $result->ce_points;
            $result->total_penalty_points = $result->penalty_points_fencing + $result->penalty_points_swimming + $result->penalty_points_riding + $result->penalty_points_ce;
            $result->save();
        }
    }

    //Csapat pontszámok és sorrendek kiszámítása
    public function team_points_order($id)
    {
        $teams = Results_team::where('competitiongroup_id', '=', $id)->get();
        foreach($teams as $team) {
            $comps = [$team->competitor1_id, $team->competitor2_id, $team->competitor3_id];
            $competitors = Result::where('competitiongroup_id', '=', $id)->whereIn('competitor_id', $comps)->get();
            $swimming_points = 0;
            $riding_points = 0;
            $ce_points = 0;
            $fencing_points = 0;
            $total_points = 0;
            foreach($competitors as  $comp) {
                $swimming_points += $comp->swimming_points;
                $riding_points += $comp->riding_points;
                $ce_points += $comp->ce_points;
                $fencing_points += $comp->fencing_points;
                $total_points += $comp->total_points;
            }
            $team->swimming_points = $swimming_points;
            $team->riding_points = $riding_points;
            $team->ce_points = $ce_points;
            $team->fencing_points = $fencing_points;
            $team->total_points = $total_points;
            $team->save();
        }

        //Vívás sorrend
        $fencing_order = Results_team::where('competitiongroup_id', '=', $id)->orderBy('fencing_points', 'desc')->get();
        $i = 0;
        foreach($fencing_order as $fence) {
            $i++;
            $fence->fencing_order = $i;
            $fence->save();
        }

        //Úszás sorrend
        $swimming_order = Results_team::where('competitiongroup_id', '=', $id)->orderBy('swimming_points', 'desc')->get();
        $i = 0;
        foreach($swimming_order as $swim) {
            $i++;
            $swim->swimming_order = $i;
            $swim->save();
        }

        //Lovas sorrend
        $riding_order = Results_team::where('competitiongroup_id', '=', $id)->orderBy('riding_points', 'desc')->get();
        $i = 0;
        foreach($riding_order as $ride) {
            $i++;
            $ride->riding_order = $i;
            $ride->save();
        }

        //Kombinált sorrend
        $ce_order = Results_team::where('competitiongroup_id', '=', $id)->orderBy('ce_points', 'desc')->get();
        $i = 0;
        foreach($ce_order as $ce) {
            $i++;
            $ce->ce_order = $i;
            $ce->save();
        }
    }

    public function swimming($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('swimming_status', '')->where('dsq_status', 0)->get();
        $swimming_rule = Swimming_ce_rule::select('swimming_dist')->where('age_group','=', $competitiongroup->age_group)->where('type','Egyéni')->get();
        $swimming_dist = $swimming_rule[0];

        //Versenyzők és időeredményeik tárolása
        $competitor_in = [];
        $competitor_swimming = [];
        $competitor_penalty_swimming = [];
        $competitor_swimming_points = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_swimming[$comp->competitor->id] = $comp->swimming_time;
            $competitor_penalty_swimming[$comp->competitor->id] = $comp->penalty_points_swimming;
            $competitor_swimming_points[$comp->competitor->id] = $comp->swimming_points;
        }
        natsort($competitor_in);

        return view('backend.results.swimming', compact('competitiongroup', 'competitor_in', 'competitor_swimming', 'swimming_dist', 'competitor_swimming_points', 'competitor_penalty_swimming'));

    }

    public function swimming_save(SwimmingSaveFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('swimming_status', '')->where('dsq_status', 0)->get();
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
            if ($request->penalty_swimming[$comp->competitor->id] || $request->penalty_swimming[$comp->competitor->id] == "0") {
                $result->penalty_points_swimming = $request->penalty_swimming[$comp->competitor->id];
            }
            else {
                $result->penalty_points_swimming = null;
            }
            $str_time =  $request->swimming[$comp->competitor->id];

            if($str_time != "") {
                //Időeredmény átalakítása másodpercekké, úszó pontszám kiszámítása
                $time_array = explode(':', $str_time);
                $minutes = $time_array[0];
                $seconds = $time_array[1];
                $x = $minutes * 60 + $seconds;
                $swimming_points = floor(($swimming_250_seconds - $x)/(1/3));
                if ($swimming_points < -250) {
                    $result->swimming_points = 0 - $request->penalty_swimming[$comp->competitor->id];
                }
                else {
                    $result->swimming_points = 250 + $swimming_points - $request->penalty_swimming[$comp->competitor->id];
                }
            }
            else {
                $result->swimming_points = 0;
                $result->swimming_order = 0;
            }
            $result->save();
        }

        //Úszó sorrend kialakítása
        $this->swimming_order($id);

        //Össz pontszám
        $this->total_points($id);

        //Csapat pontszámok
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/swimming')->with('status', 'Eredmények mentve');
    }

    public function riding($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('riding_status', '')->where('dsq_status', 0)->get();
        $horses = Horse::orderBy('name','asc')->lists('name', 'id')->all();

        $competitor_in = [];
        $competitor_riding_point = [];
        $competitor_riding_time = [];
        $competitor_horse = [];
        $competitor_riding_points = [];

        //Versenyzők neve, lovas pontszáma, lova
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_riding_point[$comp->competitor->id] = $comp->riding_point;
            $competitor_riding_time[$comp->competitor->id] = $comp->riding_time;
            $competitor_riding_points[$comp->competitor->id] = $comp->riding_points;
            if ($comp->horse != null){
                $competitor_horse[$comp->competitor->id] = $comp->horse->id;
            }
            else {
                $competitor_horse[$comp->competitor->id] = "";
            }
        }
        natsort($competitor_in);

        return view('backend.results.riding', compact('competitiongroup', 'competitor_in', 'competitor_riding_point', 'horses', 'competitor_horse', 'competitor_riding_time', 'competitor_riding_points'));
    }

    public function riding_save($id, RidingSaveFormRequest $request)
    {
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('riding_status', '')->where('dsq_status', 0)->get();
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();

        $riding_time_limit = $competitiongroup->riding_time_limit;

        //"Időeredmény 250 ponthoz" átalakítása másodpercekké
        $time_array = explode(':', $riding_time_limit);
        $minutes = $time_array[0];
        $seconds = $time_array[1];
        $riding_time_limit_seconds = $minutes * 60 + $seconds;

        //Versenyző lovas eredményeinek ill. lovának mentése
        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            if ($request->riding_point[$comp->competitor->id] || $request->riding_point[$comp->competitor->id] == "0") {
                $result->riding_point = $request->riding_point[$comp->competitor->id];
            }
            else {
                $result->riding_point = null;
            }
            if ($request->horse_id[$comp->competitor->id] != '') {
                $result->horse_id = $request->horse_id[$comp->competitor->id];
                $horse = Horse::where('id', '=', $request->horse_id[$comp->competitor->id])->firstOrFail();
                $horse->in_competition = 1;
                $horse->save();
            }
            else {
                $result->horse_id = null;
            }
            $result->riding_time = $request->riding_time[$comp->competitor->id];

            if($request->riding_time[$comp->competitor->id] != "") {
                //Időeredmény átalakítása másodpercekké, lovas pontszám kiszámítása
                $riding_time = $request->riding_time[$comp->competitor->id];
                $time_array = explode(':', $riding_time);
                $minutes = $time_array[0];
                $seconds = $time_array[1];
                $x = $minutes * 60 + $seconds;
                $riding_time_diff = ceil(($x - $riding_time_limit_seconds));
                if ($riding_time_diff > $request->riding_point[$comp->competitor->id]) {
                    $result->riding_points = 0;
                }
                else {
                    $result->riding_points =  $request->riding_point[$comp->competitor->id] - $riding_time_diff;
                }
            }
            else {
                $result->riding_points = 0;
                $result->riding_order = 0;
            }

            $result->save();
        }

        //Lovas sorrend kialakítása
        $this->riding_order($id);

        //Össz pontszám
        $this->total_points($id);

        //Csapat pontszámok
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/riding')->with('status', 'Eredmények mentve');
    }

    public function ce($id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('ce_status', '')->where('dsq_status', 0)->get();
        $ce_rule = Swimming_ce_rule::select('ce_dist')->where('age_group','=', $competitiongroup->age_group)->where('type','Egyéni')->get();
        $ce_dist = $ce_rule[0];

        //Versenyzők és kombinált időeredményeik tárolása
        $competitor_in = [];
        $competitor_ce = [];
        $competitor_ce_points = [];
        $competitor_penalty_ce = [];
        foreach ($competitor_list as $comp) {
            $competitor_in[$comp->competitor->id] = $comp->competitor->full_name;
            $competitor_ce[$comp->competitor->id] = $comp->ce_time;
            $competitor_ce_points[$comp->competitor->id] = $comp->ce_points;
            $competitor_penalty_ce[$comp->competitor->id] = $comp->penalty_points_ce;
        }
        natsort($competitor_in);

        return view('backend.results.ce', compact('competitiongroup', 'competitor_in', 'competitor_ce', 'competitor_ce_points', 'ce_dist', 'competitor_penalty_ce'));
    }

    public function ce_save(CeSaveFormRequest $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('ce_status', '')->where('dsq_status', 0)->get();
        $ce_500 = DB::table('swimming_ce_rules')->select('ce_time')->where('age_group','=',$competitiongroup->age_group)->where('type','=','Egyéni')->get();

        //"Időeredmény 500 ponthoz" átalakítása másodpercekké
        $str_time = $ce_500[0]->ce_time;
        $time_array = explode(':', $str_time);
        $minutes = $time_array[0];
        $seconds = $time_array[1];
        $ce_500_seconds = $minutes * 60 + $seconds;

        foreach ($competitor_list as $comp) {
            $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $comp->competitor->id)->firstOrFail();
            if ($request->penalty_ce[$comp->competitor->id] || $request->penalty_ce[$comp->competitor->id] == "0") {
                $result->penalty_points_ce = $request->penalty_ce[$comp->competitor->id];
            }
            else {
                $result->penalty_points_ce = null;
            }
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
                    $result->ce_points = 0 - $request->penalty_ce[$comp->competitor->id];
                }
                else {
                    $result->ce_points = 500 + $ce_points - $request->penalty_ce[$comp->competitor->id];
                }
            }
            else {
                $result->ce_points = 0;
                $result->ce_order = 0;
            }
            $result->save();
        }

        //Kombinált sorrend kialakítása
        $this->ce_order($id);

        //Össz pontszám
        $this->total_points($id);

        //Csapat pontszámok
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/ce')->with('status', 'Eredmények mentve');
    }

    public function fencing(Request $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->where('fencing_status', '')->where('dsq_status', 0)->orderBy('competitor_id')->get();
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

        //Kiválasztott versenyző büntetőpont
        $competitor_penalty_fencing = [];
        $act_comp = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $act_competitor)->first();
        $competitor_penalty_fencing[$act_competitor] = $act_comp->penalty_points_fencing;

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

        return view('backend.results.fencing', compact('competitiongroup', 'competitor_in', 'competitor_in_opp', 'competitor_list', 'act_competitor', 'fencing_results', 'bouts_per_match',
            'competitor_penalty_fencing'));
    }

    public function fencing_save(FencingSaveFormRequest $request, $id)
    {
        $act_competitor = $request->act_comp;
        $fencing_result = Fencing_result::where('competitiongroup_id', '=', $id)->get();

        $act_comp = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $act_competitor)->first();
        if ($request->penalty_fencing[$act_competitor] || $request->penalty_fencing[$act_competitor] == "0") {
            $act_comp->penalty_points_fencing = $request->penalty_fencing[$act_competitor];
        }
        else {
            $act_comp->penalty_points_fencing = null;
        }
        $act_comp->save();

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

        //Vívás pontszámok
        $this->total_fencing_points($id);

        //Össz pontszám
        $this->total_points($id);

        //Csapat pontszámok
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/fencing?competitor='.$act_competitor.'')->with('status', 'Eredmények mentve');
    }

    public function special(Request $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->orderBy('competitor_id')->where('dsq_status', 0)->get();

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

        $specials = ['Részt vett', 'Nem indult el', 'Feladta/Nem ért célba', 'Kihagyta'];

        //Úszás spec
        $swimming = [];
        foreach($competitor_list as $comp) {
            if ($comp->swimming_status == "DNS")
                $swimming[$comp->competitor->id] = 1;
            else if ($comp->swimming_status == "DNF") {
                $swimming[$comp->competitor->id] = 2;
            }
            else if ($comp->swimming_status == "ELI") {
                $swimming[$comp->competitor->id] = 3;
            }
            else {
                $swimming[$comp->competitor->id] = 0;
            }
        }

        //Lovaglás spec
        $riding = [];
        foreach($competitor_list as $comp) {
            if ($comp->riding_status == "DNS")
                $riding[$comp->competitor->id] = 1;
            else if ($comp->riding_status == "DNF") {
                $riding[$comp->competitor->id] = 2;
            }
            else if ($comp->riding_status == "ELI") {
                $riding[$comp->competitor->id] = 3;
            }
            else {
                $riding[$comp->competitor->id] = 0;
            }
        }

        //Kombinált spec
        $ce = [];
        foreach($competitor_list as $comp) {
            if ($comp->ce_status == "DNS")
                $ce[$comp->competitor->id] = 1;
            else if ($comp->ce_status == "DNF") {
                $ce[$comp->competitor->id] = 2;
            }
            else if ($comp->ce_status == "ELI") {
                $ce[$comp->competitor->id] = 3;
            }
            else {
                $ce[$comp->competitor->id] = 0;
            }
        }

        //Vívás spec
        $fencing = [];
        foreach($competitor_list as $comp) {
            if ($comp->fencing_status == "DNS")
                $fencing[$comp->competitor->id] = 1;
            else if ($comp->fencing_status == "DNF") {
                $fencing[$comp->competitor->id] = 2;
            }
            else if ($comp->fencing_status == "ELI") {
                $fencing[$comp->competitor->id] = 3;
            }
            else {
                $fencing[$comp->competitor->id] = 0;
            }
        }

        return view('backend.competitiongroups.special', compact('competitiongroup', 'competitor_in', 'act_competitor', 'specials', 'swimming', 'riding', 'ce', 'fencing'));
    }

    public function special_save(Request $request, $id)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $act_competitor = $request->act_comp;
        $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $act_competitor)->first();

        //Úszás specek
        if ($request->swimming == 1 || $request->swimming == 2 || $request->swimming == 3) {
            $result->swimming_status = "DNS";
            $result->swimming_points = 0;
            $result->swimming_order = 0;
            $result->penalty_points_swimming = 0;
            $result->save();
        }
        if ($request->swimming == 2) {
            $result->swimming_status = "DNF";
            $result->swimming_points = 0;
            $result->swimming_order = 0;
            $result->penalty_points_swimming = 0;
            $result->save();
        }
        if ($request->swimming == 3) {
            $result->swimming_status = "ELI";
            $result->swimming_points = 0;
            $result->swimming_order = 0;
            $result->penalty_points_swimming = 0;
            $result->save();
        }

        //Lovaglás specek
        if ($request->riding == 1) {
            $result->riding_status = "DNS";
            $result->riding_points = 0;
            $result->riding_order = 0;
            $result->save();
        }
        if ($request->riding == 2) {
            $result->riding_status = "DNF";
            $result->riding_points = 0;
            $result->riding_order = 0;
            $result->save();
        }
        if ($request->riding == 3) {
            $result->riding_status = "ELI";
            $result->riding_points = 0;
            $result->riding_order = 0;
            $result->save();
        }

        //Kombinált specek
        if ($request->ce == 1) {
            $result->ce_status = "DNS";
            $result->ce_points = 0;
            $result->ce_order = 0;
            $result->penalty_points_ce = 0;
            $result->save();
        }
        if ($request->ce == 2) {
            $result->ce_status = "DNF";
            $result->ce_points = 0;
            $result->ce_order = 0;
            $result->penalty_points_ce = 0;
            $result->save();
        }
        if ($request->ce == 3) {
            $result->ce_status = "ELI";
            $result->ce_points = 0;
            $result->ce_order = 0;
            $result->penalty_points_ce = 0;
            $result->save();
        }

        //Vívás specek
        if ($request->fencing == 1 || $request->fencing == 2 || $request->fencing == 3) {
            $result->fencing_win = null;
            $result->fencing_lose = null;
            $result->fencing_points = 0;
            $result->fencing_order = 0;
            $result->penalty_points_fencing = 0;
            $result->save();

            $competitiongroup->fencing_bouts = $competitiongroup->fencing_bouts - $competitiongroup->bouts_per_match;
            $competitiongroup->save();

            $fencing_results1 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor1_id', '=', $act_competitor)->get();
            $fencing_results2 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor2_id', '=', $act_competitor)->get();

            foreach ($fencing_results1 as $fence) {
                $fence->delete();
            }

            foreach ($fencing_results2 as $fence) {
                $fence->delete();
            }

            if ($request->fencing == 1) {
                $result->fencing_status = "DNS";
                $result->save();
            }
            if ($request->fencing == 2) {
                $result->fencing_status = "DNF";
                $result->save();
            }
            if ($request->fencing == 3) {
                $result->fencing_status = "ELI";
                $result->save();
            }
        }

        //Sorrendek
        $this->riding_order($id);
        $this->swimming_order($id);
        $this->ce_order($id);
        $this->total_fencing_points($id);
        $this->total_points($id);
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/special?competitor='.$act_competitor.'')->with('status', 'Módosítások elmentve.');
    }

    public function dsq($id, Request $request) {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $competitor_list = Result::where('competitiongroup_id', '=', $id)->orderBy('competitor_id')->where('dsq_status', 0)->get();

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

        return view('backend.competitiongroups.dsq', compact('competitiongroup', 'competitor_in', 'act_competitor'));
    }

    public function dsq_save($id, Request $request)
    {
        $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
        $act_competitor = $request->act_comp;
        $result = Result::where('competitiongroup_id', '=', $id)->where('competitor_id', '=', $act_competitor)->first();
        $result->dsq_status = 1;
        $result->fencing_win = null;
        $result->fencing_lose = null;
        $result->fencing_points = 0;
        $result->penalty_points_fencing = null;
        $result->fencing_order = 0;
        $result->swimming_time = "";
        $result->swimming_points = 0;
        $result->penalty_points_swimming = null;
        $result->swimming_order = 0;
        $result->riding_point = 0;
        $result->riding_time = "";
        $result->riding_points = 0;
        $result->horse_id = null;
        $result->riding_order = 0;
        $result->ce_time = "";
        $result->ce_points = 0;
        $result->penalty_points_ce = null;
        $result->ce_order = 0;
        $result->total_points = 0;
        $result->total_penalty_points = null;
        $result->save();

        $competitiongroup->fencing_bouts = $competitiongroup->fencing_bouts - $competitiongroup->bouts_per_match;
        $competitiongroup->save();

        $fencing_results1 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor1_id', '=', $act_competitor)->get();
        $fencing_results2 = Fencing_result::where('competitiongroup_id', '=', $id)->where('competitor2_id', '=', $act_competitor)->get();
        foreach ($fencing_results1 as $fence) {
            $fence->delete();
        }

        foreach ($fencing_results2 as $fence) {
            $fence->delete();
        }

        //Sorrendek
        $this->riding_order($id);
        $this->swimming_order($id);
        $this->ce_order($id);
        $this->total_fencing_points($id);
        $this->total_points($id);
        $this->team_points_order($id);

        return redirect('admin/competitiongroups/'.$id.'/dsq')->with('status', 'Versenyző kizárva.');
    }
}