<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;


Route::prefix('admin/pages')->group(function () {
    Route::get('',              [PagesController::class,'list'])->name('admin:pages');
    Route::get('add',           [PagesController::class,'form'])->name('admin:pages:add');
    Route::get('edit/{id}',     [PagesController::class,'form'])->name('admin:pages:edit');
    Route::post('save',         [PagesController::class,'save'])->name('admin:pages:save');
    Route::get('delete/{id}',   [PagesController::class,'delete'])->name('admin:pages:delete');

});

Route::get('{alias}', [PagesController::class, 'showPage']);
