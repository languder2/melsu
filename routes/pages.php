<?php

use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\PageCabinetController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/pages')->group(function () {
    Route::get('',              [PagesController::class,'list'])->name('admin:pages');
    Route::get('add',           [PagesController::class,'form'])->name('admin:pages:add');
    Route::get('edit/{id}',     [PagesController::class,'form'])->name('admin:pages:edit');
    Route::post('save',         [PagesController::class,'save'])->name('admin:pages:save');
    Route::get('delete/{id}',   [PagesController::class,'delete'])->name('admin:pages:delete');

});

Route::get('{page}', [PagesController::class, 'showPage'])->name('pages.public.link');

Route::prefix('cabinet/pages')->middleware(\App\Http\Middleware\AuthCabinet::class)->group(function () {
    Route::get('',              [PageCabinetController::class,'list'])->name('pages.cabinet.list');
    Route::get('on-approval',   [PageCabinetController::class,'list'])->name('pages.cabinet.on-approval')
        ->defaults('onApproval', true);

    Route::get('form/{page?}',  [PageCabinetController::class,'form'])->name('pages.cabinet.form');

    Route::put('save/{page?}',  [PageCabinetController::class,'save'])->name('pages.cabinet.save');

});

