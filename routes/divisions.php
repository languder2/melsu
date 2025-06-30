<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Division\DivisionController;

Route::prefix('admin/divisions')->group(function () {
    Route::get('form/{current?}',  [DivisionController::class, 'form'])->name('division:admin:form');
});

Route::controller(DivisionController::class)
    ->middleware('isAdmin')
    ->prefix('admin/divisions')
    ->group(function () {

        Route::get('add', 'form')->name('admin:division:add');
        Route::get('edit/{id?}', 'form')->name('admin:division:edit');
        Route::post('save', 'save')->name('admin:division:save');
        Route::get('delete/{id}', 'delete')->name('admin:division:delete');

        Route::get('{group?}', 'adminList')->name('admin:division:list');
    });
