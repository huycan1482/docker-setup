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

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/uploads', 'App\Http\Controllers\Controller@testUpload');
Route::post('/uploads', 'App\Http\Controllers\Controller@upload')->name('post_uploads');