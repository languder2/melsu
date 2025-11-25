<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Cabinet\TicketController;
use App\Http\Controllers\Cabinet\ApprovalController;

Route::get('', [CabinetController::class,'index'])->name('cabinet:index');

Route::get('exit', function(){
    auth()->logout();
    return redirect()->back();
})->name('cabinet:exit');

Route::post('auth',                         [CabinetController::class,'login'])->name('cabinet:auth');

Route::get('tickets',                       [TicketController::class,'list'])->name('ticket:list');
Route::get('ticket/add',                    [TicketController::class,'form'])->name('ticket:add');
Route::get('ticket/edit/{ticket?}',         [TicketController::class,'form'])->name('ticket:edit');
Route::post('ticket/save/{ticket?}',        [TicketController::class,'save'])->name('ticket:save');

Route::post('approval',                     [ApprovalController::class, 'list'])->name('approval.list');
