<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Partners\PartnerController;
use App\Http\Controllers\Partners\CabinetPartnerController;

Route::prefix('admin/partners')->group(function () {
    Route::get('form/{partner?}',   [PartnerController::class, 'form'])->name('partners.form');
    Route::get('save/{partner?}',   [PartnerController::class, 'save'])->name('partners.save');
});

Route::prefix('admin/partners/{entity?}/{entity_id?}')->group(function () {
    Route::get('list',              [PartnerController::class, 'list'])->name('partners.relation.list');
    Route::get('form/{partner?}',   [PartnerController::class, 'form'])->name('partners.relation.form');
    Route::get('save/{partner?}',   [PartnerController::class, 'save'])->name('partners.relation.save');
});

Route::prefix('cabinet/partners/{entity}/{entity_id}/')->middleware(\App\Http\Middleware\AuthCabinet::class)->group(function () {
    Route::get('/',                                 [CabinetPartnerController::class, 'list'])          ->name('partners.cabinet.list');
    Route::get('form/{goal?}',                      [CabinetPartnerController::class, 'form'])          ->name('partners.cabinet.form');
    Route::put('save/{goal?}',                      [CabinetPartnerController::class, 'save'])          ->name('partners.cabinet.save');
    Route::delete('delete/{goal?}',                 [CabinetPartnerController::class, 'delete'])        ->name('partners.cabinet.delete');
    Route::get('change-sort/{goal?}/{direction?}',  [CabinetPartnerController::class, 'changeSort'])    ->name('partners.cabinet.change-sort')->defaults('direction', 'down');
});

Route::prefix('cabinet/partner-categories/{entity}/{entity_id}/')->middleware(\App\Http\Middleware\AuthCabinet::class)->group(function () {
    Route::get('form/{category?}',                      [CabinetPartnerController::class, 'categoryForm'])          ->name('partner-categories.cabinet.form');
    Route::put('save/{category?}',                      [CabinetPartnerController::class, 'categorySave'])          ->name('partner-categories.cabinet.save');
    Route::delete('delete/{category?}',                 [CabinetPartnerController::class, 'categoryDelete'])        ->name('partner-categories.cabinet.delete');
    Route::get('change-sort/{category}/{direction}',    [CabinetPartnerController::class, 'categoryChangeSort'])    ->name('partner-categories.cabinet.change-sort')->defaults('direction', 'down');
});
