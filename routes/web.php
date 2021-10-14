<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\UserController;
use App\Services\FileManager;
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

Route::get('/', [GeneralController::class,'slashRedirect']);
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::group(['middleware'=>'auth'],function () {

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    // Protocols
    Route::get('/protocol/create/{type}',[ProtocolController::class,'create'])->name('protocol.create');
    Route::post('/protocol/store',[ProtocolController::class,'store'])->name('protocol.store');
    Route::get('/protocol/{id}',[ProtocolController::class,'show'])->name('protocol.show');
    Route::get('/protocol/{id}/edit',[ProtocolController::class,'edit'])->name('protocol.edit');
    Route::put('/protocol/{id}',[ProtocolController::class,'update'])->name('protocol.update');

    Route::group(['middleware' => 'ajax'],function () {
        // Protocol Status Change
        Route::post('/protocol/change-status',[ProtocolController::class,'changeStatus']);
        // File Download
        Route::post('/deletefile/{protocol}/{id}',[FileManager::class,'deleteFile']);
        // Global Search
        Route::get('/global-search', [GeneralController::class, 'globalSearch']);
    });
    Route::get('/download/{protocol}/{id}',[FileManager::class,'downloadFile'])->name('downloadFile');

    Route::get('/records',[RecordsController::class,'index'])->name('records.index');
    Route::get('/records/data',[RecordsController::class,'tableData'])->middleware('ajax')->name('records.getData');

    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('/activity/data',[ActivityController::class,'tableData'])->middleware('ajax')->name('activity.getData');

    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::post('/password-change', [UserController::class, 'passwordChange'])->name('password.change');
});

require __DIR__.'/auth.php';
