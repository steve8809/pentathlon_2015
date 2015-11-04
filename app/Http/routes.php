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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

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
    Route::resource('roles', 'RolesController');
    Route::post('roles/{id?}/edit', 'RolesController@update');

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



});