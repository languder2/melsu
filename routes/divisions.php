<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Division\DivisionController;

Route::prefix('admin/divisions')->group(function () {
    Route::get('form/{current?}',  [DivisionController::class, 'form'])->name('division:admin:form');
});

Route::middleware('isAdmin')
    ->prefix('admin/divisions')
    ->group(function () {

        Route::get('',                                          [DivisionController::class, 'admin'])           ->name('admin:division:list');
        Route::get('add',                                       [DivisionController::class, 'form'])            ->name('admin:division:add');
        Route::get('edit/{id?}',                                [DivisionController::class, 'form'])            ->name('admin:division:edit');
        Route::post('save',                                     [DivisionController::class, 'save'])            ->name('admin:division:save');
        Route::get('delete/{id}',                               [DivisionController::class, 'delete'])          ->name('admin:division:delete');

        Route::get('{division}/staffs',                         [DivisionController::class, 'staffsAdmin'])     ->name('division:admin:staffs:list');
        Route::get('{division}/staffs/{type}/form/{staff?}',    [DivisionController::class, 'staffsForm'])      ->name('division:admin:staffs:form');
        Route::put ('{division}/staffs/{type}/save/{staff?}',   [DivisionController::class, 'staffsSave'])      ->name('division:admin:staffs:save');
        Route::delete('staffs/delete/{staff?}',                 [DivisionController::class, 'staffsDelete'])    ->name('division:admin:staffs:delete');

        Route::get('{division}/documents',                      [DivisionController::class, 'documentsAdmin'])  ->name('division:admin:documents:list');
        Route::get('{division}/documents/form/{documents?}',    [DivisionController::class, 'documentsForm'])   ->name('division:admin:documents:form');
        Route::put ('{division}/documents/save/{documents?}',   [DivisionController::class, 'documentsSave'])   ->name('division:admin:documents:save');
        Route::delete('documents/delete/{documents?}',          [DivisionController::class, 'documentsDelete']) ->name('division:admin:documents:delete');

    });
