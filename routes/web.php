<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('accueil', function () {
    return view('vendor/accueil');
});
Route::get('admin', function () {
    return view('administration/admin');
});
Route::get('bannable', function () {
    return view('administration/bannable');
});








//Function Road

Route::post('/recorddemande', 'controle_whitelist@record_dem');
Route::post('/ajout_whitelist', 'controle_whitelist@ajout_whitelist');
Route::post('/refus_whitelist', 'controle_whitelist@refus_whitelist');
Route::get('steamlogin', 'SteamController@steamlogin');
Route::post('/banvalide', 'controle_whitelist@ban_steamid');
