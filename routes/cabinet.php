<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Cabinet\TicketController;
use App\Http\Controllers\News\CabinetNewsController;
use App\Http\Controllers\Division\CabinetDivisionsController;
use App\Http\Middleware\AuthCabinet;

Route::get('', [CabinetController::class,'index'])->name('cabinet:index');

Route::get('exit', function(){
    auth()->logout();
    return redirect()->back();
})->name('cabinet:exit');

Route::post('auth', [CabinetController::class,'login'])->name('cabinet:auth');

Route::get('tickets', [TicketController::class,'list'])->name('ticket:list');
Route::get('ticket/add', [TicketController::class,'form'])->name('ticket:add');
Route::get('ticket/edit/{ticket?}', [TicketController::class,'form'])->name('ticket:edit');
Route::post('ticket/save/{ticket?}', [TicketController::class,'save'])->name('ticket:save');

Route::prefix('news')->middleware(AuthCabinet::class)->group(function () {
    Route::get('',              [CabinetNewsController::class, 'list'])->name('news.cabinet.list');
    Route::post('set-filter',   [CabinetNewsController::class, 'setFilter'])->name('news.cabinet.set-filter');
    Route::get('form/{news?}',  [CabinetNewsController::class, 'form'])->name('news.cabinet.form');
    Route::put('save/{news?}',  [CabinetNewsController::class, 'save'])->name('news.cabinet.save');
    Route::delete('delete/{news?}',  [CabinetNewsController::class, 'delete'])->name('news.cabinet.delete');
    Route::get('on-approval', [CabinetNewsController::class, 'onApproval'])->name('cabinet.news.onApproval');

});

Route::prefix('divisions')->middleware(AuthCabinet::class)->group(function () {
    Route::get('', [CabinetDivisionsController::class, 'list'])->name('divisions.cabinet.list');
});

