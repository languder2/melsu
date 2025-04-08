<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cabinet\CabinetController;

Route::get('', [CabinetController::class,'index'])->name('cabinet:index');

Route::get('exit', function(){
    auth()->logout();
    return redirect()->back();
})->name('cabinet:exit');

Route::post('auth', [CabinetController::class,'login'])->name('cabinet:auth');

