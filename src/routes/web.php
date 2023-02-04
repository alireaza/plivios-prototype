<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => '/user', 'as' => 'user.'], function (): void {
    Route::group(['prefix' => '/register'], function (): void {
        Route::get('/', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });

    Route::get('/', [UserController::class, 'show'])->name('show')->middleware('auth');
});

Route::group(['prefix' => '/auth', 'as' => 'auth.'], function (): void {
    Route::get('/', [AuthenticationController::class, 'create'])->name('create');
    Route::post('/', [AuthenticationController::class, 'store'])->name('store');

    Route::delete('/', [AuthenticationController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => '/download', 'as' => 'download.', 'middleware' => 'auth'], function (): void {
    Route::get('/', [DownloadController::class, 'index'])->name('index');

    Route::group(['prefix' => '/create'], function (): void {
        Route::get('/', [DownloadController::class, 'create'])->name('create');
        Route::post('/', [DownloadController::class, 'store'])->name('store');
    });

    Route::group(['prefix' => '/edit'], function (): void {
        Route::get('/{id}', [DownloadController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [DownloadController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => '/delete'], function (): void {
        Route::get('/{id}', [DownloadController::class, 'delete'])->name('delete');
        Route::delete('/{id}', [DownloadController::class, 'destroy'])->name('destroy');
    });
});
