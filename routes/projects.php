<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\ClustersController;
use App\Http\Controllers\Projects\ProjectsController;

Route::prefix('admin/projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'admin'])->name('projects.admin');
    Route::get('form/{current?}', [ProjectsController::class, 'form'])->name('projects.form');
    Route::post('save/{current?}', [ProjectsController::class, 'save'])->name('projects.save');
    Route::get('delete/{current?}', [ProjectsController::class, 'delete'])->name('projects.delete');
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'public'])->name('projects.list');
    Route::get('{current?}', [ProjectsController::class, 'single'])->name('projects.single');
    Route::get('{current?}/news/{news?}', [ProjectsController::class, 'news'])->name('projects.news');
    Route::get('{current?}/gallery', [ProjectsController::class, 'gallery'])->name('projects.gallery');
});

Route::prefix('admin/clusters')->group(function () {
    Route::get('/', [ClustersController::class, 'admin'])->name('clusters.admin');
    Route::get('form/{current?}', [ClustersController::class, 'form'])->name('clusters.form');
    Route::post('save/{current?}', [ClustersController::class, 'save'])->name('clusters.save');
    Route::get('delete/{current?}', [ClustersController::class, 'delete'])->name('clusters.delete');
});

Route::prefix('clusters')->group(function () {
    Route::get('/', [ClustersController::class, 'public'])->name('clusters.list');
    Route::get('{current?}', [ClustersController::class, 'single'])->name('cluster.single');
});
