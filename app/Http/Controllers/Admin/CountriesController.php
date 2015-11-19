<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use DB;

class CountriesController extends Controller
{

    public function index()
    {
        $countries = DB::table('countries')->orderBy('name', 'asc')->paginate(10);
        return view('backend.countries.index', compact('countries'));
    }
}
