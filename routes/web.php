<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
use App\Http\Controllers\Admin;

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

Route::get('/', [Main::class, 'index'])->name('main');
Route::get('/admin', [Admin::class,'index'])->name('admin');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/configuration', [Admin::class,'index'])->name('configuration');
});
