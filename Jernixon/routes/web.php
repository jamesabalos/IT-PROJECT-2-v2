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
Route::get('/about', 'PagesController@showAboutPage')->name('home');
Route::get('markAsRead/{id}','NotificationController@MarkAsRead')->name('markAsRead');
// Route::get('salesAssistant', 'SalesAssistantController@dashboard')->name('SA.dashboard');
// Route::get('admin/sales/getItems', 'AdminController@getItemsForSales')->name('salesAssistant.getItems');
Route::get('salesAssistant/notification','HomeController@getNotification')->name('salesAssistant.notification');


Route::get('salesAssistant/dashboard/getItems', 'HomeController@getItemsForDashboard')->name('SADashboard.getItems');

Route::get('salesAssistant/sales/getItemsSales', 'HomeController@getItemsForSales')->name('salesAssistant.getItemsSales');
Route::get('salesAssistant/sales', 'HomeController@sales')->name('salesAssistant.sales');
Route::Post('salesAssistant/sales/createSales', 'HomeController@createSales')->name('salesAssistant.createSales');

Route::get('salesAssistant/return', 'HomeController@return')->name('salesAssistant.return');
Route::get('salesAssistant/returns/getReturns', 'HomeController@getReturns')->name('salesAssistant.returns.getReturns');
Route::Post('salesAssistant/returns/createReturnItem', 'HomeController@createReturnItem')->name('salesAssistant.createReturnItem');
Route::get('salesAssistant/returns/getORNumber/{ORNumber}', 'HomeController@getORNumber');
Route::get('salesAssistant/returns/getORNumberItems', 'HomeController@getORNumberItems')->name('salesAssistant.getORNumberItems');
Route::get('salesAssistant/returns/getReturnedItems/{ORNumber}', 'HomeController@gerReturnedItems');
Route::Post('salesAssistant/returns/createReturnsFilter', 'HomeController@createReturnsFilter')->name('salesAssistant.createReturnsFilter');


Route::get('salesAssistant/stockAdjustment', 'HomeController@stockAdjustment')->name('salesAssistant.stockAdjustment');
Route::get('salesAssistant/stockAjustment/getStockAdjustment', 'HomeController@getStockAdjustment')->name('salesAssistant.getStockAdjustment');
Route::get('salesAssistant/stockAjustment/createStockAdjustmentFilter', 'HomeController@createStockAdjustmentFilter')->name('salesAssistant.createStockAdjustmentFilter');
Route::Post('salesAssistant/stockAjustment/createStockAdjustment', 'HomeController@createStockAdjustment')->name('salesAssistant.createStockAdjustment');

Route::get('salesAssistant/searchItem/{itemName}', 'HomeController@searchItem');

Route::Get('salesAssistant/physicalCount', 'HomeController@physicalCount')->name('salesAssistant.physicalCount');
Route::get('salesAssistant/physicalCount/getPhysicalCount', 'HomeController@getPhysicalCount')->name('salesAssistant.getPhysicalCount');
Route::Post('salesAssistant/physicalCount/startPhysicalCount', 'HomeController@startPhysicalCount')->name('salesAssistant.startPhysicalCount');
Route::Post('salesAssistant/physicalCount/stopPhysicalCount', 'HomeController@stopPhysicalCount')->name('salesAssistant.stopPhysicalCount');
Route::Post('salesAssistant/physicalCount/submitPhysicalCount', 'HomeController@submitPhysicalCount')->name('salesAssistant.submitPhysicalCount');

Route::Post('salesAssistant/changePassword','HomeController@changePassword')->name('salesAssistant.changePassword');

Route::get('salesAssistant/validateDateRange', 'HomeController@validateDateRange')->name('salesAssistant.validateDateRange');
// Route::get('salesAssistant/physicalCount/getInputValue', 'PhysicalCountController@getPhysicalCount')->name('admin.getPhysicalCount');
// Route::get('physicalCount/getInputValue', 'PhysicalCountController@getPhysicalCount')->name('admin.getPhysicalCount');

// Route::get('salesAssistant/items/getItems', 'HomeController@getItemsForItems')->name('salesAssistant.getItems');
// Route::get('salesAssistant/items', 'HomeController@items')->name('salesAssistant.items');

Route::Get('forgotPasswordForm','Auth\ForgotPasswordController@showForgotPasswordForm')->name('admin.showForgotPassword');
Route::Post('forgotPassword','Auth\ForgotPasswordController@forgotPassword')->name('admin.forgotPassword');
Route::get('salesAssistant/logout', 'Auth\LoginController@userLogout')->name('salesAssistant.logout');

Route::get('admin/notification','AdminController@getNotification')->name('admin.notification');
Route::get('admin/notification/markAsRead','AdminController@notificationMarkAsRead')->name('admin.notification.markAsRead');

Route::Post('admin/changePassword','AdminController@changePassword')->name('admin.changePassword');

Route::get('admin/dashboard/reorderitem','AdminController@reorderitems')->name('reorderitem');
Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('admin/dashboard/getDataPoints', 'AdminController@getDataPoints')->name('dashboard.getDataPoints');
Route::get('admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('admin/dashboard/createFastMovingItem', 'AdminController@createFastMovingItems')->name('admin.dashboard.createFastMovingItem');
Route::get('admin/dashboard/createSlowMovingItem', 'AdminController@createSlowMovingItems')->name('admin.dashboard.createSlowMovingItem');

Route::get('admin/sales/getItems', 'AdminController@getItemsForSales')->name('dashboard.getItems');
Route::get('admin/sales/getDamaged', 'AdminController@getDamagedForSales')->name('dashboard.getDamaged');
Route::get('admin/sales', 'AdminController@sales')->name('admin.sales');
Route::Post('admin/sales/createSales', 'AdminController@createSales')->name('admin.createSales');

Route::get('admin/purchases', 'AdminController@purchases')->name('admin.purchases');
Route::get('admin/purchases/getPurchases', 'AdminController@getPurchases')->name('purchases.getPurchases');
Route::Post('admin/purchaes/createPurchase', 'AdminController@createPurchases')->name('admin.createPurchases');
Route::get('admin/purchaes/createPurchasesFilter', 'AdminController@createPurchasesFilter')->name('purchases.createPurchasesFilter');
Route::Get('admin/purchases/getPurchaseOrder/{poid}', 'AdminController@getPurchaseOrder');

Route::get('admin/searchItem/{itemName}', 'AdminController@searchItem');

Route::get('admin/returns', 'AdminController@returns')->name('admin.returns');
Route::get('admin/returns/getReturns', 'AdminController@getReturns')->name('returns.getReturns');
Route::Post('admin/returns/createReturnItem', 'AdminController@createReturnItem')->name('admin.createReturnItem');
Route::Post('admin/returns/createRefund', 'AdminController@createRefund')->name('admin.createRefund');
Route::get('admin/returns/getORNumber/{ORNumber}', 'AdminController@getORNumber');
Route::get('admin/returns/getORNumberItems', 'AdminController@getORNumberItems')->name('admin.getORNumberItems');
Route::get('admin/returns/getReturnedItems', 'AdminController@gerReturnedItems')->name('admin.getReturnedItems');
Route::Post('admin/returns/createReturnsFilter', 'AdminController@createReturnsFilter')->name('returns.createReturnsFilter');

Route::get('admin/physicalCount', 'AdminController@physicalCount')->name('admin.physicalCount');
Route::get('admin/physicalCount/getPhysicalCount', 'AdminController@getPhysicalCount')->name('admin.getPhysicalCount');
Route::Post('admin/physicalCount/startPhysicalCount', 'AdminController@startPhysicalCount')->name('admin.startPhysicalCount');
Route::Post('admin/physicalCount/stopPhysicalCount', 'AdminController@stopPhysicalCount')->name('admin.stopPhysicalCount');
    

Route::Get('/admin/items/viewHistory/{id}', 'AdminController@viewItemHistory');
Route::Post('/admin/items/updateStatus', 'AdminController@updateItemStatus');
Route::Post('admin/items/editItem', 'AdminController@editItem')->name('admin.editItem');
Route::Post('admin/storeNewItem', 'AdminController@storeNewItem')->name('admin.Newitems');
Route::Post('admin/items/addQuantity','AdminController@addQuantity');
Route::Post('admin/items/subtractQuantity','AdminController@subtractQuantity');
Route::Post('admin/items/returnItem','AdminController@returnItem');
Route::get('admin/items/getItems', 'AdminController@getItemsForItems')->name('items.getItems');
Route::get('admin/items', 'AdminController@items')->name('admin.items');

Route::get('admin/reports', 'AdminController@reports')->name('admin.reports');
Route::get('admin/reports/getReports', 'AdminController@getReports')->name('reports.getReports');
Route::get('admin/reports/getDamagedItems', 'AdminController@getDamagedItems')->name('reports.getDamagedItems');
Route::get('admin/reports/getLostItems', 'AdminController@getLostItems')->name('reports.getLostItems');
Route::get('admin/reports/createReportSoldItems', 'AdminController@createReportSoldItems')->name('reports.createReportSoldItems');
Route::get('admin/reports/createReportDamagedItems', 'AdminController@createReportDamagedItems')->name('reports.createReportDamagedItems');
Route::get('admin/reports/createReportLostItems', 'AdminController@createReportLostItems')->name('reports.createReportLostItems');
Route::get('admin/reports/validateDateRange', 'AdminController@validateDateRange')->name('reports.validateDateRange');


// Route::DELETE('admin/employees/destroyEmployeeAccount/{id}', 'AdminController@destroyEmployeeAccount')->name('admin.destroyEmployeeAccount');
Route::Put('admin/employees/updateEmployeeAccount/{id}', 'AdminController@updateEmployeeAccount')->name('admin.updateEmployeeAccount');
Route::Post('admin/employees/addNewEmployee', 'AdminController@addNewEmployee')->name('admin.addNewEmployee');
Route::Post('admin/employees/addNewAdmin', 'AdminController@addNewAdmin')->name('admin.addNewAdmin');
Route::get('admin/employees', 'AdminController@employees')->name('admin.employees');
Route::Post('admin/employees/resetPassword', 'AdminController@employeeResetPassword');


Route::get('admin/stockAjustment', 'AdminController@stockAdjustment')->name('admin.stockAdjustment');
Route::get('admin/stockAjustment/getStockAdjustment', 'AdminController@getStockAdjustment')->name('stockAdjustment.getStockAdjustment');
Route::Post('admin/stockAjustment/createStockAdjustment', 'AdminController@createStockAdjustment')->name('admin.createStockAdjustment');
Route::get('admin/stockAjustment/createStockAdjustmentFilter', 'AdminController@createStockAdjustmentFilter')->name('stockAdjustment.createStockAdjustmentFilter');
