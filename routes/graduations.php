<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Minor\GraduationController;

Route::prefix('cabinet/graduations/{entity}/{entity_id}/')
    ->middleware(AuthCabinet::class)
    ->group(function () {
        Route::get('/',                                     [GraduationController::class, 'list'])
                                                                ->name('graduations.cabinet.list');

        Route::get('on-approval',                           [GraduationController::class, 'list'])
                                                                ->name('graduations.cabinet.on-approval')
                                                                ->defaults('onApproval', true);

        Route::get('form/{graduation?}',                    [GraduationController::class, 'form'])
                                                                ->name('graduations.cabinet.form');

        Route::put('save/{graduation?}',                    [GraduationController::class, 'save'])
                                                                ->name('graduations.cabinet.save');

        Route::delete('delete/{graduation?}',               [GraduationController::class, 'delete'])
                                                                ->name('graduations.cabinet.delete');

        Route::get('change-sort/{graduation?}/{direction?}',[GraduationController::class, 'changeSort'])
                                                                ->name('graduations.cabinet.change-sort')
                                                                ->defaults('direction', 'down');
});
