<?php

use App\Http\Controllers\Info\InfoController;
use App\Http\Controllers\Info\CateringController;
use App\Http\Controllers\Info\ObjectsController;
use App\Http\Controllers\Education\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('sveden')->group(function () {
    Route::get('', function (){
        return redirect()->route('info:common');
    });

    Route::get('common',            [InfoController::class, 'common'])->name('info:common');
    Route::get('struct',            [InfoController::class, 'struct'])->name('info:struct');
    Route::get('document',          [InfoController::class, 'document'])->name('info:document');
    Route::get('education',         [InfoController::class, 'education'])->name('info:education');
    Route::get('education-summary', [InfoController::class, 'educationSummary'])->name('info:education:summary');
    Route::get('education-test',    [InfoController::class, 'educationTest'])->name('info:education:test');
    Route::get('eduStandarts',      [InfoController::class, 'standards'])->name('info:eduStandarts');
    Route::get('managers',          [InfoController::class, 'managers'])->name('info:managers');
    Route::get('employees',         [InfoController::class, 'employees'])->name('info:employees');
//    Route::get('objects',           [InfoController::class, 'objects'])->name('info:objects');
    Route::get('grants',            [InfoController::class, 'grants'])->name('info:grants');
    Route::get('paid_edu',          [InfoController::class, 'paid'])->name('info:paid_edu');
    Route::get('budget',            [InfoController::class, 'budget'])->name('info:budget');
    Route::get('vacant',            [InfoController::class, 'vacant'])->name('info:vacant');
    Route::get('inter',             [InfoController::class, 'inter'])->name('info:inter');

    Route::get('wip', function (\App\Models\Info\InfoBase $info){
        return view('info.wip', compact('info'));
    });

    Route::get('login',             [InfoController::class, 'login'])->name('info:login');
    Route::get('exit',              [InfoController::class, 'exit'])->name('info:exit');

    Route::get('delete/{item}',     [InfoController::class, 'delete'])->name('info:delete');

    Route::get('form/{type}/{code}/{id?}',  [InfoController::class, 'form'])->name('info:form:common');
    Route::post('save/{type}/{code}/{id?}',  [InfoController::class, 'save'])->name('info:save');

    Route::get('founder/form/{founder?}',  [InfoController::class, 'formFounder'])->name('info:form:founder');
    Route::post('founder/save/{founder?}',  [InfoController::class, 'saveFounder'])->name('info:founder:save');

    Route::get('documents/form/{type}/{code}/{info?}',
        [InfoController::class, 'formDocument'])->name('info:document:form');
    Route::post('documents/save/{type}/{code}/{info?}',
        [InfoController::class, 'saveDocument'])->name('info:document:save');

    /* catering */

    Route::get('catering',                      [CateringController::class, 'index'])->name('info:catering');
    Route::get('catering/form/{code}/{info?}',  [CateringController::class, 'form'])->name('info:catering:form');
    Route::post('catering/save/{info?}',        [CateringController::class, 'save'])->name('info:catering:save');
    Route::get('catering/delete/{item}',        [CateringController::class, 'delete'])->name('info:catering:delete');

    /* end catering */
    /* Education */


    /* End education */

});

Route::prefix('education-profile')->group(function (){
    Route::post('document/save/{profile?}/{document?}',    [ProfileController::class, 'saveDocument'])
        ->name('education-profile.document.save');

    Route::get('document/modal/{profile?}/{document?}',    [ProfileController::class, 'modalDocument'])
        ->name('education-profile.document.modal');

    Route::get('nir/{profile?}',    [ProfileController::class, 'modalNir'])
        ->name('education-profile.nir.modal');
    Route::post('nir/save/{profile?}',    [ProfileController::class, 'saveNir'])
        ->name('education-profile.nir.save');

    Route::get('job/{item?}',    [ProfileController::class, 'modalJob'])
        ->name('education-profile.job.modal');
    Route::post('job/save/{item?}',    [ProfileController::class, 'saveJob'])
        ->name('education-profile.job.save');
});

Route::get('info/form/{type}/{code}/{info?}',  [InfoController::class, 'form'])->name('info:form');


Route::prefix('sveden/objects')->group(function (){
    Route::get('',                      [ObjectsController::class, 'index'])->name('info:objects');

    Route::get('form/{code}/{info?}',   [ObjectsController::class, 'form'])->name('info:objects:form');

    Route::post('save/{code}/{info?}',  [ObjectsController::class, 'save'])->name('info:objects:save');

    Route::get('delete/{info?}',        [ObjectsController::class, 'delete'])->name('info:objects:delete');
});

