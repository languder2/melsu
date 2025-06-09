<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Division\DivisionController;

Route::prefix('admin/divisionss')->group(function () {
    Route::get('form/{current?}',  [DivisionController::class, 'form'])->name('division:admin:form');
});

