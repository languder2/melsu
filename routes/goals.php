<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Minor\GoalsController;

Route::prefix('cabinet/goals/{entity}/{entity_id}/')->middleware(AuthCabinet::class)->group(function () {
    Route::get('/',                                     [GoalsController::class, 'list'])
                                                            ->name('goals.cabinet.list');

    Route::get('on-approval',                           [GoalsController::class, 'list'])
                                                            ->name('goals.cabinet.on-approval')
                                                            ->defaults('onApproval', true);

    Route::get('form/{goal?}',                          [GoalsController::class, 'form'])
                                                            ->name('goals.cabinet.form');

    Route::put('save/{goal?}',                          [GoalsController::class, 'save'])
                                                            ->name('goals.cabinet.save');

    Route::delete('delete/{goal?}',                     [GoalsController::class, 'delete'])
                                                            ->name('goals.cabinet.delete');

    Route::get('change-sort/{goal?}/{direction?}',      [GoalsController::class, 'changeSort'])
                                                            ->name('goals.cabinet.change-sort')
                                                            ->defaults('direction', 'down');

    Route::get('change-approved/{range?}/{action?}',    [GoalsController::class, 'changeApproved'])
                                                            ->name('goals.cabinet.change-approved')
                                                            ->defaults('range', 'all')
                                                            ->defaults('action', 'set');
});
