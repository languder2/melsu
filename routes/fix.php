<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\FixController;

Route::middleware(['auth.api'])->prefix('fix')->group(function () {
    Route::get('document-categories-sort', [FixController::class, 'documentCategoriesSort']);
});
