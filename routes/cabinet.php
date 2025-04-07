<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cabinet\Cabinet;

Route::get('', [Cabinet::class,'index'])->name('cabinet:index');

Route::get('exit', function(){
    auth()->logout();
    return redirect()->back();
})->name('cabinet:exit');

Route::post('auth', function(){
    auth()->login(\App\Models\User::find(1));
    return redirect()->back();
})->name('cabinet:auth');

