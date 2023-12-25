<?php

use App\Http\Controllers\Web\V1\DashboardController;
use App\Http\Controllers\Web\V1\HomeController;
use App\Http\Controllers\Web\V1\ProfileController;
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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {
    Auth::routes();
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'auth'], function (){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::group(['prefix' => 'profile'], function (){
            Route::get('me', [ProfileController::class, 'index'])->name('me');
            Route::post('update-my-profile/{id}', [ProfileController::class, 'update'])->name('update.profile');
            Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
            Route::post('destroy-account', [ProfileController::class, 'destroy'])->name('destroy.account');
        });
    });
});

