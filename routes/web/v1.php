<?php

use App\Http\Controllers\Web\V1\DashboardController;
use App\Http\Controllers\Web\V1\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Auth::routes();
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'auth'], function (){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::group(['prefix' => 'profile'], function (){
        });
    });
});

