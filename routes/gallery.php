<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Gallery\AdminImage;
use App\Http\Controllers\Gallery\PublicGallery;
use App\Http\Controllers\Gallery\AdminImageGallery;
use App\Http\Controllers\Gallery\AdminVideoGallery;

use App\Http\Controllers\Gallery\GalleryController;


Route::prefix('admin/gallery')->group(function () {
    Route::get('add-images/{gallery?}', [GalleryController::class, 'formMultiUploads'])->name('gallery:images:add');
});
