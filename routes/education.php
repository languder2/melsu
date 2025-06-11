<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Education\SpecialityController;

Route::prefix('admin/specialities')
    ->group(function () {

        Route::get(
            '',
            [SpecialityController::class,'admin']
        )->name('admin:speciality:list');

        Route::get(
            'edit/{current?}',
            [SpecialityController::class,'form']
        )->name('speciality:admin:form');

        Route::post(
            'save/{current?}',
            [SpecialityController::class,'save']
        )->name('speciality:save');

        Route::get(
            'delete/{speciality}',
            [SpecialityController::class,'delete']
        )->name('admin:speciality:delete');

        Route::post(
            'set-filter',
            [SpecialityController::class,'setFilter']
        )->name('specialities:admin:set-filter');

    });


Route::get(
    'specialities',
    [SpecialityController::class,'showAll']
)->name('public:education:specialities:all');

Route::get(
    'specialities/{speciality}',
    [SpecialityController::class,'showSingle']
)->name('public:education:speciality');

Route::get(
    'education-programs-higher-education',
    [SpecialityController::class,'educationProgramsHigherEducation']
)->name('education-programs:higher-education');

Route::get(
    'education-programs',
    [SpecialityController::class,'adminEducationPrograms']
)->name('admin:education:programs');
