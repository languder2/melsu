<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Minor\ScienceController;

Route::prefix('cabinet/science/{entity}/{entity_id}/')
    ->middleware(AuthCabinet::class)
    ->group(function () {
        Route::get('/',                                     [ScienceController::class, 'list'])
                                                                ->name('science.cabinet.list');

        Route::get('on-approval',                           [ScienceController::class, 'list'])
                                                                ->name('science.cabinet.on-approval')
                                                                ->defaults('onApproval', true);

        Route::get('form/{science?}',                        [ScienceController::class, 'form'])
                                                                ->name('science.cabinet.form');

        Route::put('save/{science?}',                        [ScienceController::class, 'save'])
                                                                ->name('science.cabinet.save');

        Route::delete('delete/{science?}',                   [ScienceController::class, 'delete'])
                                                                ->name('science.cabinet.delete');

        Route::get('change-sort/{science?}/{direction?}',    [ScienceController::class, 'changeSort'])
                                                                ->name('science.cabinet.change-sort')
                                                                ->defaults('direction', 'down');
});
