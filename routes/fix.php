<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\FixController;

Route::prefix('fix')->group(function () {
    Route::get('divisions-cabinet-lines',      [FixController::class, 'divisionsCabinetLines']);
});

Route::prefix('fix')->group(function () {
    Route::get('document-categories-sort',      [FixController::class, 'documentCategoriesSort']);
});

Route::prefix('fix/employees')->group(function () {
    Route::get('set-uuid',                          [FixController::class, 'employeesSetUUID']);
});
