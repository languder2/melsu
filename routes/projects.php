<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Projects\ClustersController;
use App\Http\Controllers\Projects\ProjectsController;


Route::prefix('admin/projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'admin'])->name('projects.admin');
    Route::get('form/{project?}', [ProjectsController::class, 'form'])->name('projects.form');
    Route::post('save/{project?}', [ProjectsController::class, 'save'])->name('projects.save');
    Route::get('delete/{project?}', [ProjectsController::class, 'delete'])->name('projects.delete');
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'public'])->name('projects.list');
    Route::get('{project?}', [ProjectsController::class, 'project'])->name('projects.project');
    Route::get('{project?}/news/{news?}', [ProjectsController::class, 'news'])->name('projects.news');
    Route::get('{project?}/gallery', [ProjectsController::class, 'gallery'])->name('projects.gallery');
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


Route::get('menu/projects',[ClustersController::class, 'public']);
