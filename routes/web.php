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
    return redirect()->to('/login');
});

//start POS 
Route::get('/outlet/login', 'Auth\LoginController@getUserLogin');

//end POS 
Route::post('/login/user', 'Auth\LoginController@postUserLogin');
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
Route::get('/register', 'Auth\LoginController@register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/outlet/dashboard', 'PosController@ouletDashboard');
    Route::get('/outlet/order-table', 'PosController@OrderTable');

    Route::get('/outlet/menu-list-by-category-id/{CategoryId}/{outlet_id}', 'PosController@MenuListByCategoryId');

    Route::get('/outlet/order-table-details/{tableId}', 'PosController@GetOrderTableDetails');
    Route::get('/outlet/order-table-mneu-details/{OrderId}', 'PosController@GetOrderTableMenu');
    Route::get('/outlet/order-details-byid/{OrderId}', 'PosController@GetOrderDetailsByOrderId');

    Route::post('/outlet/save-print-kot', 'PosController@SavePrintKOT');
    Route::post('/outlet/save-print-bill', 'PosController@SavePrintBill');
    Route::post('/outlet/save-payment-bill', 'PosController@SavePaymentAndSettleBill');    
    Route::post('/outlet/settle-bill', 'PosController@SettleBill');

    Route::post('/outlet/save-quick-bill', 'PosController@SaveQuickBill');


    Route::get('/outlet/report', 'OutletReportController@ReportDashboard');
    // Route::group(['middleware' => ['waiter']], function () {
    //     Route::get('/oulet/dashboard', 'PosController@OrderTable');
    // });

    // Route::group(['middleware' => ['manager']], function () {
    //     Route::get('/oulet/dashboard', 'PosController@OrderTable');
    // });

    // Admin
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

            Route::get('/outlet-user', 'Admin\OutletController@outletUserList');
            Route::get('/add-user', 'Admin\OutletController@getAddUser');
            Route::post('/add-user', 'Admin\OutletController@postAddUser');
            Route::get('/edit-user/{id}', 'Admin\OutletController@getEditUser');

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

            Route::get('/coupon-list', 'Admin\MasterController@couponList');
            Route::get('/add-coupon', 'Admin\MasterController@getCoupon');
            Route::post('/add-coupon', 'Admin\MasterController@postCoupon');
            Route::get('/edit-coupon/{id}', 'Admin\MasterController@getEditCoupon');

            Route::get('/usertype-list', 'Admin\MasterController@userTypeList');
            Route::get('/add-usertype', 'Admin\MasterController@getuserType');
            Route::post('/add-usertype', 'Admin\MasterController@postuserType');
            Route::get('/edit-usertype/{id}', 'Admin\MasterController@getEdituserType');

            // Menu Management
            Route::get('/menu-management/menu-categories', 'Admin\MeneuManagementController@menuCategoriesList');
            Route::get('/menu-management/add-menu-categories', 'Admin\MeneuManagementController@getAddMenuCategories');
            Route::post('/menu-management/add-menu-categories', 'Admin\MeneuManagementController@postAddMenuCategories');
            Route::get('/menu-management/edit-menu-categories/{id}', 'Admin\MeneuManagementController@getEditMenuCategories');

            Route::get('/menu-management/menu-catalogues', 'Admin\MeneuManagementController@menuCataloguesList');
            Route::get('/menu-management/add-menu-catalogues', 'Admin\MeneuManagementController@getAddMenuCatalogues');
            Route::post('/menu-management/add-menu-catalogues', 'Admin\MeneuManagementController@postAddMenuCatalogues');
            Route::get('/menu-management/edit-menu-catalogues/{id}', 'Admin\MeneuManagementController@getEditMenuCatalogues');

            Route::get('/menu-management/outlet-menu', 'Admin\MeneuManagementController@outletMenuList');
            Route::get('/menu-management/add-outlet-menu', 'Admin\MeneuManagementController@getAddOutletMenu');
            Route::post('/menu-management/add-outlet-menu', 'Admin\MeneuManagementController@postAddOutletMenu');
            Route::get('/menu-management/edit-outlet-menu/{id}', 'Admin\MeneuManagementController@getEditOutletMenu');

            Route::get('/menu-management/add-item/{id}', 'Admin\MeneuManagementController@getAddItem');
            Route::post('/menu-management/add-item', 'Admin\MeneuManagementController@postAddItem');
        });
    });
});
