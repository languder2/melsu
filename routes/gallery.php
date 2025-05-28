<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Gallery\AdminImage;
use App\Http\Controllers\Gallery\PublicGallery;
use App\Http\Controllers\Gallery\AdminImageGallery;
use App\Http\Controllers\Gallery\AdminVideoGallery;


Route::prefix('admin/gallery')->group(function () {
    Route::get('add-images/{gallery?}', [AdminImageGallery::class, 'formMultiUploads'])->name('gallery:images:add');
});
