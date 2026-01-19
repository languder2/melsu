<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\SvedenController;


Route::prefix('sveden')->group(function () {
    Route::get('', function (){
        return redirect()->route('sveden:common');
    });

    Route::get('common',            [SvedenController::class, 'common'])->name('sveden:common');
});
