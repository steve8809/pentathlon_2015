<?php

namespace App\Http\Controllers;

use App\Results_team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competitiongroup;
use App\Result;
use App\Competition;
use App\Competitor;

class PageController extends Controller
{
    public function index()
    {
        $competition = Competition::orderBy('date', 'desc')->first();
        if($competition) {
            $competitiongroups = Competitiongroup::where('competition_id', '=', $competition->id)->orderBy('date', 'desc')->get();
            if (!$competitiongroups->isEmpty()) {
                $competitiongroup = Competitiongroup::where('competition_id', '=', $competition->id)->orderBy('date', 'desc')->firstorFail();
                $results = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 0)->orderBy('total_points', 'desc')->get();
                $results_dsq = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 1)->get();
                $teams = Results_team::where('competitiongroup_id', '=', $competitiongroup->id)->orderBy('total_points', 'desc')->get();
            }
        }

        return view('home', compact('competition', 'competitiongroups', 'competitiongroup', 'results', 'results_dsq', 'teams'));
    }

    public function select($id)
    {
        $competition = Competition::orderBy('date', 'desc')->first();
        $competitiongroups = Competitiongroup::where('competition_id', '=', $competition->id)->orderBy('date', 'desc')->get();
        if (!$competitiongroups->isEmpty()) {
            $competitiongroup = Competitiongroup::whereId($id)->firstOrFail();
            $results = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 0)->orderBy('total_points', 'desc')->get();
            $results_dsq = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 1)->get();
            $teams = Results_team::where('competitiongroup_id', '=', $competitiongroup->id)->orderBy('total_points', 'desc')->get();
        }
        return view('home', compact('competition', 'competitiongroups', 'competitiongroup', 'results', 'results_dsq', 'teams'));
    }

    public function competitions()
    {
        $competitions = Competition::orderBy('date', 'desc')->paginate(10);
        return view('competitions', compact('competitions'));
    }

    public function competition_show($id)
    {
        $competition = Competition::whereId($id)->first();
        $competitiongroups = Competitiongroup::where('competition_id', '=', $id)->orderBy('date', 'desc')->get();
        if (!$competitiongroups->isEmpty()) {
            $competitiongroup = Competitiongroup::where('competition_id', '=', $competition->id)->orderBy('date', 'desc')->firstOrFail();
            $results = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 0)->orderBy('total_points', 'desc')->get();
            $results_dsq = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 1)->get();
            $teams = Results_team::where('competitiongroup_id', '=', $competitiongroup->id)->orderBy('total_points', 'desc')->get();
        }
        return view('home', compact('competition', 'competitiongroups', 'competitiongroup', 'results', 'results_dsq', 'teams'));
    }

    public function competition_select($id, $subid)
    {
        $competition = Competition::whereId($id)->first();
        $competitiongroups = Competitiongroup::where('competition_id', '=', $competition->id)->orderBy('date', 'desc')->get();
        if (!$competitiongroups->isEmpty()) {
            $competitiongroup = Competitiongroup::whereId($subid)->firstOrFail();
            $results = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 0)->orderBy('total_points', 'desc')->get();
            $results_dsq = Result::where('competitiongroup_id', '=', $competitiongroup->id)->where('dsq_status', 1)->get();
            $teams = Results_team::where('competitiongroup_id', '=', $competitiongroup->id)->orderBy('total_points', 'desc')->get();
        }
        return view('home', compact('competition', 'competitiongroups', 'competitiongroup', 'results', 'results_dsq', 'teams'));
    }

    public function statistics()
    {
        //Úszás és kombinált távok mentése
        $swim_200 = ['Ifi B', 'Ifi A', 'Junior', 'Felnőtt', 'Senior'];
        $swim_100 = ['Ifi C', 'Ifi D'];
        $swim_50 = ['Ifi E', 'Ifi F'];

        $ce_3200 = ['Ifi A', 'Junior', 'Felnőtt', 'Senior'];
        $ce_2400 = ['Ifi B'];
        $ce_1600 = ['Ifi C'];
        $ce_800 = ['Ifi D'];
        $ce_400 = ['Ifi E', 'Ifi F'];

        //Vívás legjobb
        $best_fencing_female = Result::where('sex', '=', 'Nő')->where('fencing_points', '!=', 0)->orderBy('fencing_points', 'desc')->first();
        $best_fencing_male = Result::where('sex', '=', 'Férfi')->where('fencing_points', '!=', 0)->orderBy('fencing_points', 'desc')->first();

        //Totál legjobb
        $best_total_female = Result::where('sex', '=', 'Nő')->where('total_points', '!=', 0)->orderBy('total_points', 'desc')->first();
        $best_total_male = Result::where('sex', '=', 'Férfi')->where('total_points', '!=', 0)->orderBy('total_points', 'desc')->first();

        //Úszás legjobbak
        $best_swimming_200_female = Result::whereIn('age_group', $swim_200)->where('sex', '=', 'Nő')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();
        $best_swimming_200_male = Result::whereIn('age_group', $swim_200)->where('sex', '=', 'Férfi')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();

        $best_swimming_100_female = Result::whereIn('age_group', $swim_100)->where('sex', '=', 'Nő')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();
        $best_swimming_100_male = Result::whereIn('age_group', $swim_100)->where('sex', '=', 'Férfi')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();

        $best_swimming_50_female = Result::whereIn('age_group', $swim_50)->where('sex', '=', 'Nő')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();
        $best_swimming_50_male = Result::whereIn('age_group', $swim_50)->where('sex', '=', 'Férfi')->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();

        //Kombinált legjobbak
        $best_ce_3200_female = Result::whereIn('age_group', $ce_3200)->where('sex', '=', 'Nő')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_3200_male = Result::whereIn('age_group', $ce_3200)->where('sex', '=', 'Férfi')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        $best_ce_2400_female = Result::whereIn('age_group', $ce_2400)->where('sex', '=', 'Nő')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_2400_male = Result::whereIn('age_group', $ce_2400)->where('sex', '=', 'Férfi')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        $best_ce_1600_female = Result::whereIn('age_group', $ce_1600)->where('sex', '=', 'Nő')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_1600_male = Result::whereIn('age_group', $ce_1600)->where('sex', '=', 'Férfi')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        $best_ce_800_female = Result::whereIn('age_group', $ce_800)->where('sex', '=', 'Nő')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_800_male = Result::whereIn('age_group', $ce_800)->where('sex', '=', 'Férfi')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        $best_ce_400_female = Result::whereIn('age_group', $ce_400)->where('sex', '=', 'Nő')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_400_male = Result::whereIn('age_group', $ce_400)->where('sex', '=', 'Férfi')->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        return view('statistics', compact('best_fencing_female', 'best_fencing_male', 'best_total_female', 'best_total_male', 'best_swimming_200_female', 'best_swimming_200_male',
            'best_swimming_100_female', 'best_swimming_100_male', 'best_swimming_100_male', 'best_swimming_50_female', 'best_swimming_50_male', 'best_ce_3200_female', 'best_ce_3200_male',
            'best_ce_2400_female', 'best_ce_2400_male', 'best_ce_1600_female', 'best_ce_1600_male', 'best_ce_800_female', 'best_ce_800_male',
            'best_ce_400_female', 'best_ce_400_male'));
    }

    public function competitor_statistics(Request $request)
    {
        $competitors = Competitor::all();

        //Nevezett versenyzők
        $competitor_in = [];
        foreach ($competitors as $comp) {
            $competitor_in[$comp->id] = $comp->full_name_birthday;
        }
        natsort($competitor_in);
        reset($competitor_in);
        $act_competitor = key($competitor_in);

        //Kiválasztott versenyző
        if ($request->competitor) {
            $act_competitor = $request->competitor;
        }

        $all_result = Result::where('competitor_id', '=', $act_competitor)->orderBy('total_points', 'desc')->get();

        //Úszás és kombinált távok mentése
        $swim_200 = ['Ifi B', 'Ifi A', 'Junior', 'Felnőtt', 'Senior'];
        $swim_100 = ['Ifi C', 'Ifi D'];
        $swim_50 = ['Ifi E', 'Ifi F'];

        $ce_3200 = ['Ifi A', 'Junior', 'Felnőtt', 'Senior'];
        $ce_2400 = ['Ifi B'];
        $ce_1600 = ['Ifi C'];
        $ce_800 = ['Ifi D'];
        $ce_400 = ['Ifi E', 'Ifi F'];

        //Lovaglás legjobb
        $best_riding = Result::where('competitor_id', '=', $act_competitor)->where('riding_points', '!=', 0)->orderBy('riding_points', 'desc')->first();

        //Vívás legjobb
        $best_fencing = Result::where('competitor_id', '=', $act_competitor)->where('fencing_points', '!=', 0)->orderBy('fencing_points', 'desc')->first();

        //Totál legjobb
        $best_total = Result::where('competitor_id', '=', $act_competitor)->where('total_points', '!=', 0)->orderBy('total_points', 'desc')->first();

        //Úszás legjobbak
        $best_swimming_200 = Result::whereIn('age_group', $swim_200)->where('competitor_id', '=', $act_competitor)->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();
        $best_swimming_100 = Result::whereIn('age_group', $swim_100)->where('competitor_id', '=', $act_competitor)->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();
        $best_swimming_50 = Result::whereIn('age_group', $swim_50)->where('competitor_id', '=', $act_competitor)->where('swimming_time', '!=', '')->orderBy('swimming_time', 'asc')->first();

        //Kombinált legjobbak
        $best_ce_3200 = Result::whereIn('age_group', $ce_3200)->where('competitor_id', '=', $act_competitor)->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_2400 = Result::whereIn('age_group', $ce_2400)->where('competitor_id', '=', $act_competitor)->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_1600 = Result::whereIn('age_group', $ce_1600)->where('competitor_id', '=', $act_competitor)->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_800 = Result::whereIn('age_group', $ce_800)->where('competitor_id', '=', $act_competitor)->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();
        $best_ce_400 = Result::whereIn('age_group', $ce_400)->where('competitor_id', '=', $act_competitor)->where('ce_time', '!=', '')->orderBy('ce_time', 'asc')->first();

        return view('competitor_statistics', compact('all_result', 'competitors', 'competitor_in', 'act_competitor', 'best_riding', 'best_fencing', 'best_total', 'best_swimming_200',
            'best_swimming_100', 'best_swimming_50', 'best_ce_3200', 'best_ce_2400', 'best_ce_1600', 'best_ce_800', 'best_ce_400'));
    }

}
