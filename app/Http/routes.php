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

//Regisztráció, Felhasználók, Bejelentkezés, Kijelentkezés
Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');
Route::get('users/logout', 'Auth\AuthController@getLogout');
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');

//Admin részek, jogosultság, felhhasználók szerkesztése
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    //Admin home
    Route::get('/', 'PagesController@home');
    //Jogosultságok
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
    //Felhasználók
    Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit','UsersController@update');
    Route::resource('users', 'UsersController');
    //Lovak
    /*Route::get('horses', 'HorsesController@nidex');
    Route::get('horses/{id?}/edit', 'HorsesController@edit');
    Route::post('horses/{id?}/edit', 'UsersController@update');*/
    Route::resource('horses', 'HorsesController');
    Route::post('horses/create', 'HorsesController@store');

});