<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Middleware\isFinance;
use App\Http\Controllers\Finance\FinanceController;

Route::prefix('cabinet/finance')
    ->middleware([AuthCabinet::class, isFinance::class ])->group(function () {
        Route::get('',                          [FinanceController::class, 'index'])
                                                    ->name('finance.compilation.index');

        Route::put('upload',                    [FinanceController::class, 'upload'])
                                                    ->name('finance.compilation.upload');

        Route::get('results',                   [FinanceController::class, 'results'])
                                                    ->name('finance.compilation.results');

        Route::get('download',                  [FinanceController::class, 'download'])
                                                    ->name('finance.compilation.download');
});
