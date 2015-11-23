<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competitiongroup;
use App\Result;

class PageController extends Controller
{
    public function index()
    {
        $competitiongroup = Competitiongroup::orderBy('date', 'desc')->firstOrFail();
        $results = Result::where('competitiongroup_id', '=', $competitiongroup->id)->orderBy('total_points', 'desc')->get();
        return view('home', compact('competitiongroup', 'results'));
    }
}
