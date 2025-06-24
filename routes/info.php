<?php

use App\Http\Controllers\Minor\InfoController;
use Illuminate\Support\Facades\Route;


Route::prefix('sveden')->group(function () {
    Route::get('', function (){
        return redirect()->route('sveden:common');
    });

    Route::get('common',            [InfoController::class, 'common'])->name('sveden:common');
});
