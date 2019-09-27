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
    return view('welcome');
});

Auth::routes();

Route::resource('units','UnitsController');
Route::get('/units/show/data', 'UnitsController@data')->name('units.data');

Route::resource('clients','ClientsController');
Route::get('/clients/show/data', 'ClientsController@data')->name('clients.data');

Route::resource('orders','OrdersController');
Route::get('/orders/show/data', 'OrdersController@data')->name('orders.data');

Route::resource('users','UsersController');
Route::get('/users/show/data', 'UsersController@data')->name('users.data');

Route::resource('payment-history','PaymentHistoryController');
Route::get('/payment-history/show/data', 'PaymentHistoryController@data')->name('payment-history.data');

Route::resource('unit-type','UnitTypesController');
Route::get('/unit-type/show/data', 'UnitTypesController@data')->name('unit-type.data');

Route::resource('floors','FloorsController');
Route::get('/floors/show/data', 'FloorsController@data')->name('floors.data');

Route::resource('towers','TowersController');
Route::get('/towers/show/data', 'TowersController@data')->name('towers.data');

Route::resource('views','ViewsController');
Route::get('/views/show/data', 'ViewsController@data')->name('views.data');

Route::resource('roles','RolesController');
Route::get('/roles/show/data', 'RolesController@data')->name('roles.data');


//START CUSTOM ROUTES
//show order by status order
Route::get('/orders/status/{status}', 'OrdersController@status');
Route::get('/orders/show/data/{status}', 'OrdersController@dataByStatus');

Route::get('/roles/{id}/addpermission', 'RolesController@addpermission')->name('roles.create-permission');
Route::post('/roles/{id}/storepermission', 'RolesController@storepermission')->name('roles.store-permission');

Route::get("/order/payment/print", 'PaymentHistoryController@print')->name('payment-history.print');


Route::get('/home', 'HomeController@index')->name('home');
