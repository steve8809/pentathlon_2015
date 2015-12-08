<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('error', function() {
    try
    {
        $pdo = DB::connection('mysql')->getPdo();
    }
    catch(\PDOException $exception)
    {
        return Response::make('Database error! ' . $exception->getCode());
    }
    return 'all fine';
});

//Főoldal
Route::get('/', 'PageController@index');
Route::get('/home', 'PageController@index');
Route::get('/home/select/{id?}', 'PageController@select');

//Versenyek oldal
Route::get('/competitions', 'PageController@competitions');
Route::get('/competitions/{id?}', array('as' => 'competition.show', 'uses' => 'PageController@competition_show'));
Route::get('/competitions/{id?}/select/{subid?}', array('as' => 'competition.select', 'uses' => 'PageController@competition_select'));

//Verseny statisztikák
Route::get('/statistics', 'PageController@statistics');

//Versenyző statisztikák
Route::get('/competitor_statistics', 'PageController@competitor_statistics');

//Auth -- Regisztráció, Felhasználók, Bejelentkezés, Kijelentkezés
Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');
Route::get('users/logout', 'Auth\AuthController@getLogout');
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');

//Admin részek
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    //Admin home
    Route::get('/', 'PagesController@home');

    //Jogosultságok
    Route::get('/roles', 'RolesController@index');

    //Felhasználók
    Route::resource('users', 'UsersController');
    Route::post('users/{id?}/edit','UsersController@update');

    //Lovak
    Route::resource('horses', 'HorsesController');
    Route::post('horses/{id?}/edit', 'HorsesController@update');

    //Klubok
    Route::resource('clubs', 'ClubsController');
    Route::post('clubs/{id?}/edit', 'ClubsController@update');

    //Országok
    Route::get('countries', 'CountriesController@index');

    //Versenyzők
    Route::resource('competitors', 'CompetitorsController');
    Route::post('competitors/{id?}/edit', 'CompetitorsController@update');

    //Verseny
    Route::resource('competitions', 'CompetitionsController');
    Route::post('competitions/{id?}/edit', 'CompetitionsController@update');

    //Csoport
    Route::resource('competitiongroups', 'CompetitiongroupsController');
    Route::post('competitiongroups/{id?}/edit', 'CompetitiongroupsController@update');

    //Nevezés versenyre
    Route::get('competitiongroups/{id?}/entry', 'CompetitiongroupsController@entry');
    Route::post('competitiongroups/{id?}/entry', 'CompetitiongroupsController@entry_save');
    Route::delete('competitiongroups/destroy_entry/{id?}', array('as' => 'admin.destroy_entry',
        'uses' => 'CompetitiongroupsController@destroy_entry'));

    //Csapatok nevezése versenyre
    Route::get('competitiongroups/{id?}/entry/teams_entry', 'CompetitiongroupsController@teams_entry');
    Route::post('competitiongroups/{id?}/entry/teams_entry', 'CompetitiongroupsController@teams_entry_save');
    Route::delete('competitiongroups/destroy_team_entry/{id?}', array('as' => 'admin.destroy_team_entry',
        'uses' => 'CompetitiongroupsController@destroy_team_entry'));

    //Nevezés lezárása
    Route::post('competitiongroups/entry_close/{id?}', array('as' => 'admin.entry_close',
        'uses' => 'CompetitiongroupsController@entry_close'));

    //Úszás, kombinált szabályok
    Route::resource('swimming_ce_rules', 'SwimmingCeRulesController');
    Route::post('swimming_ce_rules/{id?}/edit', 'SwimmingCeRulesController@update');

    //Vívás szabályok
    Route::resource('fencing_rules', 'FencingRulesController');
    Route::post('fencing_rules/{id?}/edit', 'FencingRulesController@update');

    //Úszás eredmények
    Route::get('competitiongroups/{id?}/swimming', 'ResultsController@swimming');
    Route::post('competitiongroups/{id?}/swimming', 'ResultsController@swimming_save');

    //Lovaglás eredmények
    Route::get('competitiongroups/{id?}/riding', 'ResultsController@riding');
    Route::post('competitiongroups/{id?}/riding', 'ResultsController@riding_save');

    //Kombinált eredmények
    Route::get('competitiongroups/{id?}/ce', 'ResultsController@ce');
    Route::post('competitiongroups/{id?}/ce', 'ResultsController@ce_save');

    //Vívás
    Route::get('competitiongroups/{id?}/fencing', 'ResultsController@fencing');
    Route::post('competitiongroups/{id?}/fencing', 'ResultsController@fencing_save');

    //Speciális
    Route::get('competitiongroups/{id?}/special', 'ResultsController@special');
    Route::post('competitiongroups/{id?}/special', 'ResultsController@special_save');

    //Kizárás
    Route::get('competitiongroups/{id?}/dsq', 'ResultsController@dsq');
    Route::post('competitiongroups/{id?}/dsq', 'ResultsController@dsq_save');

});