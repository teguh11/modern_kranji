<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    // return view('themes.adminlte.login');
    // return view('themes.adminlte.app');
    return view('welcome');
});

// Route::get('/dapur', 'AuthController@login')->name("showloginpage");
// Route::post('/dapur', 'AuthController@login')->name("login");

Auth::routes();

Route::resource('units','UnitsController');
Route::get('/units/show/data', 'UnitsController@data')->name('units.data');
Route::get('/pembeli', 'PembeliController@index')->name('pembeli');
Route::get('/pembeli/data', 'PembeliController@datapembeli')->name('pembeli.data');
Route::get('/pembeli/create', 'PembeliController@createForm')->name('pembeli.create.form');
Route::post('/pembeli/createdata', 'PembeliController@create')->name('pembeli.create');
Route::get('/pembeli/update', 'PembeliController@updateForm')->name('pembeli.update.form');
Route::put('/pembeli/updatedata/{id}', 'PembeliController@update')->name('pembeli.update');
