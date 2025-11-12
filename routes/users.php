<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Users\UsersController;

Route::prefix('cabinet/users')->middleware(AuthCabinet::class)->group(function (){
    Route::get('/',                     [UsersController::class, 'list'])->name('users.cabinet.list');
    Route::get('form/{user?}',          [UsersController::class, 'form'])->name('users.cabinet.form');
    Route::put('save/{user?}',          [UsersController::class, 'save'])->name('users.cabinet.save');
    Route::delete('delete/{user?}',     [UsersController::class, 'delete'])->name('users.cabinet.delete');
    Route::post('set-filter',           [UsersController::class, 'setFilter'])->name('users.cabinet.set-filter');

});
