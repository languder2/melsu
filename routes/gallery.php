<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Gallery\ImageController;

Route::prefix('admin/gallery')->group(function () {
    Route::post('upload/{gallery?}',[GalleryController::class, 'upload'])   ->name('gallery:images:upload');
    Route::get('show/{gallery?}',   [GalleryController::class, 'adminShow'])->name('gallery:admin:show');


    Route::get('',                  [GalleryController::class, 'list'])->name('admin:gallery:list');
    Route::get('form/{gallery?}',   [GalleryController::class, 'form'])->name('admin:gallery:form');
    Route::post('save/{gallery?}',  [GalleryController::class, 'save'])->name('gallery:admin:save');

});


Route::middleware(['web','auth.api'])->prefix('image')->group(function () {
    Route::get('toggle-show/{image}', [ImageController::class, 'ApiToggleShow'])
        ->name('image:api:toggle-show');

    Route::get('delete/{image}', [ImageController::class, 'ApiDelete'])
        ->name('image:api:delete');
});
