<?php

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
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

Auth::routes();
Route::get('/register', 'Auth\LoginController@register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/dashboard', 'Admin\DashboardController@Index');
            Route::get('/brand', 'Admin\BrandController@index');
            Route::get('/add-brand', 'Admin\BrandController@getAddBrand');
            Route::post('/add-brand', 'Admin\BrandController@postAddBrand');
            Route::get('/edit-brand/{id}', 'Admin\BrandController@getEditBrand');

            Route::get('/outlet-designation', 'Admin\OutletController@OutletDesignationList');
            Route::get('/add-designation', 'Admin\OutletController@getAddDesignation');
            Route::post('/add-designation', 'Admin\OutletController@postAddDesignation');
            Route::get('/edit-designation/{id}', 'Admin\OutletController@getEditDesignation');
        });
    });
});
