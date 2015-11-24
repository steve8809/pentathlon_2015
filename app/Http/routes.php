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

// Főoldal
Route::get('/', 'PageController@index');
Route::get('home', 'PageController@index');

// Auth -- Regisztráció, Felhasználók, Bejelentkezés, Kijelentkezés
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
    Route::get('api/horses', array('as'=>'api.horses', 'uses'=>'HorsesController@getDatatable'));

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
    Route::post('competitiongroups/entry_close/{id?}', array('as' => 'admin.entry_close',
        'uses' => 'CompetitiongroupsController@entry_close'));

    //Úszás, kombinált szabályok
    Route::resource('swimming_ce_rules', 'SwimmingCeRulesController');
    Route::post('swimming_ce_rules/{id?}/edit', 'SwimmingCeRulesController@update');

    //Vívás szabályok
    Route::resource('fencing_rules', 'FencingRulesController');
    Route::post('fencing_rules/{id?}/edit', 'FencingRulesController@update');

    //Úszás eredmények
    Route::get('competitiongroups/{id?}/swimming', 'CompetitiongroupsController@swimming');
    Route::post('competitiongroups/{id?}/swimming', 'CompetitiongroupsController@swimming_save');

    //Lovaglás eredmények
    Route::get('competitiongroups/{id?}/riding', 'CompetitiongroupsController@riding');
    Route::post('competitiongroups/{id?}/riding', 'CompetitiongroupsController@riding_save');

    //Kombinált eredmények
    Route::get('competitiongroups/{id?}/ce', 'CompetitiongroupsController@ce');
    Route::post('competitiongroups/{id?}/ce', 'CompetitiongroupsController@ce_save');

    //Vívás
    Route::get('competitiongroups/{id?}/fencing', 'CompetitiongroupsController@fencing');
    Route::post('competitiongroups/{id?}/fencing', 'CompetitiongroupsController@fencing_save');


});