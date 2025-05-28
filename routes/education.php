<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Education\SpecialityController;

Route::prefix('admin/specialities')
    ->group(function () {

        Route::get('',                      [SpecialityController::class,'list'])
            ->name('admin:speciality:list');
        Route::get('edit/{current?}',       [SpecialityController::class,'form'])
            ->name('speciality:admin:form');
        Route::post('save/{current?}',      [SpecialityController::class,'save'])
            ->name('speciality:save');
        Route::get('delete/{speciality}',   [SpecialityController::class,'delete'])
            ->name('admin:speciality:delete');

    });


Route::get('specialities', [SpecialityController::class,'showAll'])
    ->name('public:education:specialities:all');

Route::get('specialities/{speciality}', [SpecialityController::class,'showSingle'])
    ->name('public:education:speciality');
