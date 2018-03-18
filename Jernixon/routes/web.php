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

// Route::get('/', 'PagesController@index');
Route::get('/', function(){
    return view('welcome');
})->middleware('guest:web');


// Route::get('/dashboard', 'DashboardController@index');
// Route::get('/dashboard/getItems', 'DashboardController@getItems')->name('dashboard.getItems');

// Route::get('/reports/getTransactions', 'ReportsController@getTransactions')->name('reports.getTransactions');
// Route::get('/reports/getReturns', 'ReportsController@getReturns')->name('reports.getReturns');
// Route::get('/reports/getItemsAdded', 'ReportsController@getItemsAdded')->name('reports.getItemsAdded');
// Route::get('/reports/getRemovedItems', 'ReportsController@getRemovedItems')->name('reports.getRemovedItems');
// Route::resource('reports', 'ReportsController');

// Route::Post('items/addQuantity','ItemsController@addQuantity');
// Route::Post('items/subtractQuantity','ItemsController@subtractQuantity');
// Route::Post('items/returnItem','ItemsController@returnItem');
// Route::get('/items/getItems', 'ItemsController@getItems')->name('items.getItems');
// Route::resource('items','ItemsController');


// Route::get('/employees', 'PagesController@employees');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('salesAssistant', 'SalesAssistantController@dashboard')->name('SA.dashboard');
Route::get('salesAssistant/dashboard/getItems', 'HomeController@getItemsForDashboard')->name('SADashboard.getItems');
Route::get('salesAssistant/items/getItems', 'HomeController@getItemsForItems')->name('salesAssistant.getItems');
Route::get('salesAssistant/items', 'HomeController@items')->name('salesAssistant.items');
Route::get('salesAssistant/logout', 'Auth\LoginController@userLogout')->name('salesAssistant.logout');



Route::get('admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('admin/dashboard/getDataPoints', 'AdminController@getDataPoints')->name('dashboard.getDataPoints');
Route::get('admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('admin/sales/getItems', 'AdminController@getItemsForSales')->name('dashboard.getItems');
Route::get('admin/sales', 'AdminController@sales')->name('admin.sales');

Route::get('admin/purchases', 'AdminController@purchases')->name('admin.purchases');

Route::get('admin/searchItem/{itemName}', 'AdminController@searchItem');

Route::get('admin/returns', 'AdminController@returns')->name('admin.returns');

Route::get('admin/physical_count', 'AdminController@physicalCount')->name('admin.physicalCount');


Route::Post('admin/storeNewItem', 'AdminController@storeNewItem')->name('admin.Newitems');
Route::Post('admin/items/addQuantity','AdminController@addQuantity');
Route::Post('admin/items/subtractQuantity','AdminController@subtractQuantity');
Route::Post('admin/items/returnItem','AdminController@returnItem');
Route::get('admin/items/getItems', 'AdminController@getItemsForItems')->name('items.getItems');
Route::get('admin/items', 'AdminController@items')->name('admin.items');

Route::get('admin/reports', 'AdminController@reports')->name('admin.reports');
Route::get('admin/reports/getTransactions', 'AdminController@getTransactions')->name('reports.getTransactions');
Route::get('admin/reports/getReturns', 'AdminController@getReturns')->name('reports.getReturns');
Route::get('admin/reports/getItemsAdded', 'AdminController@getItemsAdded')->name('reports.getItemsAdded');
Route::get('admin/reports/getRemovedItems', 'AdminController@getRemovedItems')->name('reports.getRemovedItems');


Route::DELETE('admin/employees/destroyEmployeeAccount/{id}', 'AdminController@destroyEmployeeAccount')->name('admin.destroyEmployeeAccount');
Route::Put('admin/employees/updateEmployeeAccount/{id}', 'AdminController@updateEmployeeAccount')->name('admin.updateEmployeeAccount');
Route::Post('admin/employees/addNewEmployee', 'AdminController@addNewEmployee')->name('admin.addNewEmployee');
Route::get('admin/employees', 'AdminController@employees')->name('admin.employees');


Route::get('admin/stockAjustment', 'AdminController@stockAdjustment')->name('admin.stockAdjustment');