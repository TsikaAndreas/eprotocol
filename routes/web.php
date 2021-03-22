<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\RecordsController;
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

Route::group(['middleware'=>'auth'],function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::get('/activity',[ActivityController::class,'index'])->name('activity');

//    Route::resource('protocol',ProtocolController::class);
    Route::get('/protocol/create/{type}',[ProtocolController::class,'create'])->name('protocol.create');
    Route::post('/protocol/store',[ProtocolController::class,'store'])->name('protocol.store');
    Route::get('/protocol/{id}',[ProtocolController::class,'show'])->name('protocol.show');
    Route::get('/protocol/{id}/edit',[ProtocolController::class,'edit'])->name('protocol.edit');
    Route::put('/protocol/{id}',[ProtocolController::class,'update'])->name('protocol.update');

    Route::get('/records',[RecordsController::class,'index'])->name('records');
    Route::get('/records/list',[RecordsController::class,'getRecords'])->name('records.list');
});

require __DIR__.'/auth.php';
