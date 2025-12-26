<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Minor\CareerController;

Route::prefix('cabinet/careers/{entity}/{entity_id}/')
    ->middleware(AuthCabinet::class)
    ->group(function () {
        Route::get('/',                                     [CareerController::class, 'list'])
                                                                ->name('careers.cabinet.list');

        Route::get('on-approval',                           [CareerController::class, 'list'])
                                                                ->name('careers.cabinet.on-approval')
                                                                ->defaults('onApproval', true);

        Route::get('form/{career?}',                        [CareerController::class, 'form'])
                                                                ->name('careers.cabinet.form');

        Route::put('save/{career?}',                        [CareerController::class, 'save'])
                                                                ->name('careers.cabinet.save');

        Route::delete('delete/{career?}',                   [CareerController::class, 'delete'])
                                                                ->name('careers.cabinet.delete');

        Route::get('change-sort/{career?}/{direction?}',    [CareerController::class, 'changeSort'])
                                                                ->name('careers.cabinet.change-sort')
                                                                ->defaults('direction', 'down');

        Route::get('change-approved/{range?}/{action?}',    [CareerController::class, 'changeApproved'])
                                                                ->name('careers.cabinet.change-approved')
                                                                ->defaults('range', 'all')
                                                                ->defaults('action', 'set');

    });
