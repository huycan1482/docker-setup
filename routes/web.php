<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/uploads', 'App\Http\Controllers\Controller@testUpload');
Route::post('/uploads', 'App\Http\Controllers\Controller@upload')->name('post_uploads');

Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', 'App\Http\Controllers\Admin\AuthController@getLogin')->name('admin.getLogin');
        Route::post('login', 'App\Http\Controllers\Admin\AuthController@postLogin')->name('admin.postLogin');
        Route::get('logout', 'App\Http\Controllers\Admin\AuthController@getLogout')->name('admin.getLogout');
        Route::get('register', 'App\Http\Controllers\Admin\AuthController@getRegister')->name('admin.getRegister');

    });

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@getDashboard')->name('admin.dashboard');
        Route::get('/', function () {
            return view('admin/index');
        });
        Route::prefix('category')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
            Route::get('/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
            Route::post('/store', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
        });
    });
});