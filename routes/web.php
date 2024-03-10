<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//start POS 
Route::get('/pos/dashboard', 'PosController@Dashboard');
Route::get('/pos/order-table', 'PosController@OrderTable');
//end POS 
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

Auth::routes();
Route::get('/register', 'Auth\LoginController@register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/dashboard', 'Admin\DashboardController@Index');

            Route::get('/brand', 'Admin\OutletController@getBrandList');
            Route::get('/add-brand', 'Admin\OutletController@getAddBrand');
            Route::post('/add-brand', 'Admin\OutletController@postAddBrand');
            Route::get('/edit-brand/{id}', 'Admin\OutletController@getEditBrand');

            Route::get('/outlet-designation', 'Admin\OutletController@designationList');
            Route::get('/add-designation', 'Admin\OutletController@getAddDesignation');
            Route::post('/add-designation', 'Admin\OutletController@postAddDesignation');
            Route::get('/edit-designation/{id}', 'Admin\OutletController@getEditDesignation');

            Route::get('/outlet-list', 'Admin\OutletController@outletList');
            Route::get('/add-outlet', 'Admin\OutletController@getAddOutlet');
            Route::post('/add-outlet', 'Admin\OutletController@postAddOutlet');
            Route::get('/edit-outlet/{id}', 'Admin\OutletController@getEditOutlet');

            Route::get('/product-group-list', 'Admin\MasterController@productGroupList');
            Route::get('/add-product-group', 'Admin\MasterController@getAddProductGroup');
            Route::post('/add-product-group', 'Admin\MasterController@postAddProductGroup');
            Route::get('/edit-product-group/{id}', 'Admin\MasterController@getEditProductGroup');

            Route::get('/tax-configuration-list', 'Admin\MasterController@taxConfigurationList');
            Route::get('/add-tax-configuration', 'Admin\MasterController@getAddTaxConfiguration');
            Route::post('/add-tax-configuration', 'Admin\MasterController@postAddTaxConfiguration');
            Route::get('/edit-tax-configuration/{id}', 'Admin\MasterController@getEditTaxConfiguration');

            Route::get('/kitchen-department-list', 'Admin\MasterController@KitchenDepartmentList');
            Route::get('/add-kitchen-department', 'Admin\MasterController@getKitchenDepartment');
            Route::post('/add-kitchen-department', 'Admin\MasterController@postKitchenDepartment');
            Route::get('/edit-kitchen-department/{id}', 'Admin\MasterController@getEditKitchenDepartment');

            Route::get('/outlet-department-list', 'Admin\MasterController@outletDepartmentList');
            Route::get('/add-outlet-department', 'Admin\MasterController@getoutletDepartment');
            Route::post('/add-outlet-department', 'Admin\MasterController@postoutletDepartment');
            Route::get('/edit-outlet-department/{id}', 'Admin\MasterController@getEditoutletDepartment');
            
            Route::get('/table-management-list', 'Admin\MasterController@TableManagementList');
            Route::get('/add-table-management', 'Admin\MasterController@getTableManagement');
            Route::post('/add-table-management', 'Admin\MasterController@postTableManagement');
            Route::get('/edit-table-management/{id}', 'Admin\MasterController@getEditTableManagement');
            Route::get('/outlet-department-data/{id}', 'Admin\MasterController@getOutletDepartmentData');
            
        });
    });
});
