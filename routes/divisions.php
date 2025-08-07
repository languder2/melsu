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

        Route::get('{division}/staffs',                 'staffsAdmin')->name('division:admin:staffs:list');
        Route::get('{division}/staffs/{type}/form/{staff?}',   'staffsForm')->name('division:admin:staffs:form');
        Route::put ('{division}/staffs/{type}/save/{staff?}',   'staffsSave')->name('division:admin:staffs:save');
        Route::delete('staffs/delete/{staff?}',           'staffsDelete')->name('division:admin:staffs:delete');

        Route::get('', 'adminList')->name('admin:division:list');
    });
