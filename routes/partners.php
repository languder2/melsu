<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\ClustersController;
use App\Http\Controllers\Projects\ProjectsController;
use App\Http\Controllers\Partners\PartnerController;

Route::prefix('admin/partners')->group(function () {
    Route::get('form/{partner?}',   [PartnerController::class, 'form'])->name('partners.form');
    Route::get('save/{partner?}',   [PartnerController::class, 'save'])->name('partners.save');
});

Route::prefix('admin/partners/{entity?}/{entity_id?}')->group(function () {
    Route::get('list',              [PartnerController::class, 'list'])->name('partners.relation.list');
    Route::get('form/{partner?}',   [PartnerController::class, 'form'])->name('partners.relation.form');
    Route::get('save/{partner?}',   [PartnerController::class, 'save'])->name('partners.relation.save');
});

