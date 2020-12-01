<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
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

Route::group(['middleware' => config('jetstream.middleware', ['auth', 'verified'])], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
        Route::post('/', [CommentController::class, 'store'])->name('store');

        Route::delete('{comment}', [CommentController::class, 'destroy'])
            ->middleware(['can:destroy,comment'])
            ->name('destroy');
    });
});
