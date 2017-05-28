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




//Function Road

Route::post('/recorddemande', 'demande_whitelist@record_dem');
Route::post('/ajout_whitelist', 'demande_whitelist@ajout_whitelist');
Route::post('/refus_whitelist', 'demande_whitelist@refus_whitelist');