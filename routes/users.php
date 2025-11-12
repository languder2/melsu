<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Users\UsersController;

Route::prefix('cabinet/users')->middleware(AuthCabinet::class)->group(function (){
    Route::get('/',                     [UsersController::class, 'list'])->name('UsersController.cabinet.list');
    Route::get('form/{user?}',          [UsersController::class, 'form'])->name('UsersController.cabinet.form');
    Route::put('save/{user?}',          [UsersController::class, 'save'])->name('UsersController.cabinet.save');
    Route::delete('delete/{user?}',     [UsersController::class, 'delete'])->name('UsersController.cabinet.delete');
});
