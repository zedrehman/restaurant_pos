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

    Route::group(['prefix' => 'usersetup'], function () {
        Route::get('/outletlist', 'UserSetupController@OutletList');
        Route::get('/editoutlet/{id}', 'UserSetupController@EditOutlet');
        Route::get('/addoutlet', 'UserSetupController@AddOutlet');
        Route::post('/addoutlet', 'UserSetupController@PostAddOutlet');

        Route::get('/userrole', 'UserSetupController@UserRole');
        Route::get('/adduserrole/{id}', 'UserSetupController@AddUserRole');
        Route::post('/SaveUserRole', 'UserSetupController@SaveUserRole');
        Route::get('/DeleteUserRole/{id}', 'UserSetupController@DeleteUserRole');

        Route::get('/customer', 'UserSetupController@Customer');
        Route::get('/addcustomer/{id}', 'UserSetupController@AddCustomer');
        Route::post('/SaveCustomer', 'UserSetupController@SaveCustomer');
        Route::get('/DeleteCustomer/{id}', 'UserSetupController@DeleteCustomer');
    });

    Route::group(['prefix' => 'appsetting'], function () {
        Route::get('/unitmaster', 'AppSettingController@UnitMaster');
        Route::get('/addunitmaster', 'AppSettingController@AddUnitMaster');
        Route::post('/addunitmaster', 'AppSettingController@PostAddUnitMaster');
        Route::get('/editunitmaster/{id}', 'AppSettingController@EditUnitMaster');
        Route::get('/deleteunitmaster/{id}', 'AppSettingController@DeleteUnitMaster');

        Route::get('/sms', 'AppSettingController@SMS');
        Route::get('/addsms', 'AppSettingController@AddSMS');
        Route::post('/addsms', 'AppSettingController@PostAddSMS');
        Route::get('/editsms/{id}', 'AppSettingController@EditSMS');
        Route::get('/deletesms/{id}', 'AppSettingController@DeleteSMS');

        Route::get('/email', 'AppSettingController@Email');
        Route::get('/addemail', 'AppSettingController@AddEmail');
        Route::post('/addemail', 'AppSettingController@PostAddEmail');
        Route::get('/editemail/{id}', 'AppSettingController@EditEmail');
        Route::get('/deleteemail/{id}', 'AppSettingController@DeleteEmail');

        Route::get('/printer', 'AppSettingController@Printer');
        Route::get('/addprinter', 'AppSettingController@AddPrinter');
        Route::post('/addprinter', 'AppSettingController@PostAddPrinter');
        Route::get('/editprinter/{id}', 'AppSettingController@EditPrinter');
        Route::get('/deleteprinter/{id}', 'AppSettingController@DeletePrinter');
    });

    Route::group(['prefix' => 'foodsetup'], function () {
        Route::get('/ingrediant', 'FoodSetupController@Ingrediant');
        Route::get('/addingrediant', 'FoodSetupController@AddIngrediant');
        Route::post('/addingrediant', 'FoodSetupController@PostAddIngrediant');
        Route::get('/editingrediant/{id}', 'FoodSetupController@EditIngrediant');
        Route::get('/deleteingrediant/{id}', 'FoodSetupController@DeleteIngrediant');
        Route::get('/ingrediantstock/{id}', 'FoodSetupController@IngrediantStock');
        Route::post('/saveingrediantstock', 'FoodSetupController@SaveIngrediantStock');

        Route::post('/GetIngrediantByOutletId', 'FoodSetupController@GetIngrediantByOutletId');

        Route::get('/modifiers', 'FoodSetupController@Modifiers');
        Route::get('/addmodifiers', 'FoodSetupController@AddModifiers');
        Route::post('/SaveModifiers', 'FoodSetupController@SaveModifiers');
        Route::get('/editmodifiers/{id}', 'FoodSetupController@EditModifiers');
        Route::get('/deletemodifiers/{id}', 'FoodSetupController@DeleteModifiers');
        Route::post('/DeleteModifiersIngredient', 'FoodSetupController@DeleteModifiersIngredient');
    });

    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/expensetype', 'ExpensesController@ExpenseType');
        Route::get('/addexpensetype', 'ExpensesController@AddExpenseType');
        Route::post('/addexpensetype', 'ExpensesController@PostAddExpenseType');
        Route::get('/editexpensetype/{id}', 'ExpensesController@EditExpenseType');
        Route::get('/deleteexpensetype/{id}', 'ExpensesController@DeleteExpenseType');

        Route::get('/outletexpenses', 'ExpensesController@OutletExpenses');
        Route::get('/addoutletexpenses', 'ExpensesController@AddOutletExpenses');
        Route::post('/addoutletexpenses', 'ExpensesController@PostAddOutletExpenses');
        Route::get('/editoutletexpenses/{id}', 'ExpensesController@EditOutletExpenses');
        Route::get('/deleteoutletexpenses/{id}', 'ExpensesController@DeleteOutletExpenses');
    });

    Route::group(['prefix' => 'outlet'], function () {
        Route::get('/pos', 'PosController@OutletPOS');
        Route::get('/redirect-to-pos/{CategoryId}', 'PosController@RedirectToPOS');

        Route::get('/order-table', 'PosController@OrderTable');

        Route::get('/menu-list-by-category-id/{CategoryId}/{outlet_id}', 'PosController@MenuListByCategoryId');

        Route::get('/order-table-details/{tableId}', 'PosController@GetOrderTableDetails');
        Route::get('/order-table-mneu-details/{OrderId}', 'PosController@GetOrderTableMenu');
        Route::get('/order-details-byid/{OrderId}', 'PosController@GetOrderDetailsByOrderId');

        Route::post('/save-print-kot', 'PosController@SavePrintKOT');
        Route::post('/save-print-bill', 'PosController@SavePrintBill');
        Route::post('/save-payment-bill', 'PosController@SavePaymentAndSettleBill');
        Route::post('/settle-bill', 'PosController@SettleBill');
        Route::post('/save-quick-bill', 'PosController@SaveQuickBill');
        Route::get('/all-bills', 'OutletReportController@AllBills');
        Route::get('/report', 'OutletReportController@ReportDashboard');
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/overallreports', 'ReportsController@OverAllReports');

        Route::get('/expensesreports', 'ReportsController@ExpensesReports');
        Route::post('/GetExpensesDetailsReportsByDate', 'ReportsController@GetExpensesDetailsReportsByDate');

        Route::get('/stockalertreports', 'ReportsController@StockAlertReports');
    });

    Route::group(['prefix' => 'kitchen'], function () {
        Route::get('/orderlist', 'KitchenController@OrderList');
        Route::get('/departmentorder', 'KitchenController@DepartmentOrder');

        Route::post('/GetKitchenOrderDetails', 'KitchenController@GetKitchenOrderDetails');
    });


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
            Route::get('/DeleteUser/{id}', 'Admin\OutletController@DeleteUser');

            Route::get('/product-group-list', 'Admin\MasterController@productGroupList');
            Route::get('/add-product-group', 'Admin\MasterController@getAddProductGroup');
            Route::post('/add-product-group', 'Admin\MasterController@postAddProductGroup');
            Route::get('/edit-product-group/{id}', 'Admin\MasterController@getEditProductGroup');

            Route::get('/tax-configuration-list', 'Admin\MasterController@taxConfigurationList');
            Route::get('/add-tax-configuration', 'Admin\MasterController@getAddTaxConfiguration');
            Route::post('/add-tax-configuration', 'Admin\MasterController@postAddTaxConfiguration');
            Route::get('/edit-tax-configuration/{id}', 'Admin\MasterController@getEditTaxConfiguration');
            Route::get('/delete-tax-configuration/{id}', 'Admin\MasterController@DeleteTaxConfiguration');

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
            Route::get('/delete-table-management/{id}', 'Admin\MasterController@DeleteTableManagement');

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
            Route::post('/menu-management/delete-menu-ingredient', 'Admin\MeneuManagementController@DeleteMenuIngredient');

            Route::get('/menu-management/outlet-menu', 'Admin\MeneuManagementController@outletMenuList');
            Route::get('/menu-management/add-outlet-menu', 'Admin\MeneuManagementController@getAddOutletMenu');
            Route::post('/menu-management/add-outlet-menu', 'Admin\MeneuManagementController@postAddOutletMenu');
            Route::get('/menu-management/edit-outlet-menu/{id}', 'Admin\MeneuManagementController@getEditOutletMenu');

            Route::get('/menu-management/add-item/{id}', 'Admin\MeneuManagementController@getAddItem');
            Route::post('/menu-management/add-item', 'Admin\MeneuManagementController@postAddItem');
        });
    });
});
