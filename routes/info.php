<?php

use App\Http\Controllers\Minor\InfoController;
use Illuminate\Support\Facades\Route;


Route::prefix('sveden')->group(function () {
    Route::get('', function (){
        return redirect()->route('info:common');
    });

    Route::get('common',            [InfoController::class, 'common'])->name('info:common');
    Route::get('struct',            [InfoController::class, 'struct'])->name('info:struct');
    Route::get('document',          [InfoController::class, 'document'])->name('info:document');
    Route::get('education',         [InfoController::class, 'education'])->name('info:education');
    Route::get('eduStandarts',      [InfoController::class, 'standards'])->name('info:eduStandarts');
    Route::get('managers',          [InfoController::class, 'managers'])->name('info:managers');
    Route::get('employees',         [InfoController::class, 'employees'])->name('info:employees');
    Route::get('objects',           [InfoController::class, 'objects'])->name('info:objects');
    Route::get('grants',            [InfoController::class, 'grants'])->name('info:grants');
    Route::get('paid_edu',          [InfoController::class, 'paid_edu'])->name('info:paid_edu');
    Route::get('budget',            [InfoController::class, 'budget'])->name('info:budget');
    Route::get('vacant',            [InfoController::class, 'vacant'])->name('info:vacant');
    Route::get('inter',             [InfoController::class, 'inter'])->name('info:inter');
    Route::get('catering',          [InfoController::class, 'catering'])->name('info:catering');
});
