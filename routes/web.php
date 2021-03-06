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
    return redirect(route('login'));
});
Route::get('/home', function () {
    return view('themes.adminlte.home');
})->name('home');

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

Route::get("/report/unit", 'ReportController@unit')->name('report.unit');
Route::get("/report/unit/data", 'ReportController@dataunit')->name('report.unit.data');
Route::get("/report/order", 'ReportController@order')->name('report.order');
Route::get("/report/order/data", 'ReportController@dataorder')->name('report.order.data');
Route::get("/report/transaction", 'ReportController@transaction')->name('report.transaction');
Route::get("/report/transaction/data", 'ReportController@datatransaction')->name('report.transaction.data');


// Route::get('/home', 'HomeController@index')->name('home');
