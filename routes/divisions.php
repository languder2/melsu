<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Division\DivisionController;
use App\Http\Controllers\Division\CabinetDivisionsController;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\Division\DivisionCompilationController;
use App\Http\Middleware\InstanceAccess;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Division\DivisionMatchingController;

Route::prefix('admin/divisions')->group(function () {
    Route::get('form/{current?}',  [DivisionController::class, 'form'])->name('division:admin:form');
});

Route::middleware('isAdmin')
    ->prefix('admin/divisions')
    ->group(function () {

        Route::get('',                                                  [DivisionController::class, 'admin'])
            ->name('admin:division:list');

        Route::get('add',                                               [DivisionController::class, 'form'])
            ->name('admin:division:add');

        Route::get('edit/{id?}',                                        [DivisionController::class, 'form'])
            ->name('admin:division:edit');

        Route::post('save',                                             [DivisionController::class, 'save'])
            ->name('admin:division:save');

        Route::get('{division}/staffs',                                 [DivisionController::class, 'staffsAdmin'])
            ->name('division:admin:staffs:list');

        Route::get('{division}/staffs/{type}/form/{staff?}',            [DivisionController::class, 'staffsForm'])
            ->name('division:admin:staffs:form');

        Route::put ('{division}/staffs/{type}/save/{staff?}',           [DivisionController::class, 'staffsSave'])
            ->name('division:admin:staffs:save');

        Route::delete('staffs/delete/{staff?}',                         [DivisionController::class, 'staffsDelete'])
            ->name('division:admin:staffs:delete');

        Route::get('{division}/documents',                              [DivisionController::class, 'documentsAdmin'])
            ->name('division:admin:documents:list');

        Route::get('{division}/documents/form/{category?}/{document?}', [DivisionController::class, 'documentsForm'])
            ->name('division:admin:documents:form');

        Route::put ('{division}/documents/save/{document?}',            [DivisionController::class, 'documentsSave'])
            ->name('division:admin:documents:save');

        Route::delete('documents/delete/{documents?}',                  [DivisionController::class, 'documentsDelete'])
            ->name('division:admin:documents:delete');

        Route::get('{division}/document-categories/form/{category?}',   [DivisionController::class, 'documentCategoryForm'])
            ->name('division:admin:document-categories:form');

        Route::put ('{division}/document-categories/save/{category?}',  [DivisionController::class, 'documentCategorySave'])
            ->name('division:admin:document-categories:save');

        Route::delete('document-categories/delete/{category?}',         [DivisionController::class, 'documentCategoryDelete'])
            ->name('division:admin:document-categories:delete');
    });

Route::prefix('cabinet/divisions')
    ->middleware([AuthCabinet::class])
    ->group(function () {

        Route::get('',                                      [CabinetDivisionsController::class, 'list'])
            ->name('divisions.cabinet.list');

        Route::get('statuses',                              [CabinetDivisionsController::class, 'statuses'])
            ->name('divisions.cabinet.statuses');
    });

Route::prefix('cabinet/divisions')
    ->middleware([AuthCabinet::class, InstanceAccess::class])
    ->group(function () {

        Route::get('form/{division?}',                      [CabinetDivisionsController::class, 'form'])
            ->name('division.cabinet.form');

        Route::put('save/{division?}',                      [CabinetDivisionsController::class, 'save'])
            ->name('division.cabinet.save');

        Route::delete('delete/{division}',                  [CabinetDivisionsController::class, 'delete'])
            ->name('divisions.delete');

        Route::post('set-filter',                           [CabinetDivisionsController::class, 'setFilter'])
            ->name('divisions.cabinet.set-filter');

        Route::get('history/form/{division?}',              [CabinetDivisionsController::class, 'historyForm'])
            ->name('division.history.form');

        Route::put('history/save/{division?}',              [CabinetDivisionsController::class, 'historySave'])
            ->name('division.history.save');

        Route::get('achievements/form/{division?}',         [CabinetDivisionsController::class, 'achievementsForm'])
            ->name('division.achievements.form');

        Route::put('achievements/save/{division?}',         [CabinetDivisionsController::class, 'achievementsSave'])
            ->name('division.achievements.save');

        Route::get('gallery/form/{division?}',              [CabinetDivisionsController::class, 'galleryForm'])
            ->name('division.gallery.form');

        Route::put('gallery/save/{division?}',              [CabinetDivisionsController::class, 'gallerySave'])
            ->name('division.gallery.save');

    });

Route::prefix('cabinet/divisions')->middleware([AuthCabinet::class, IsAdmin::class])->group(function () {
    Route::get('matching-uuid',                         [DivisionMatchingController::class, 'UUID'])
                                                            ->name('division.matching.uuid');

    Route::put('{division}/change-uuid/',               [DivisionMatchingController::class, 'changeUUID'])
                                                            ->name('division.change.uuid');


});

Route::get('institutes',                                [EducationController::class, 'institutes'])
                                                            ->name('public:education:institutes');

Route::get('faculties',                                 [EducationController::class, 'faculties'])
                                                            ->name('public:education:faculties');

Route::get('{type}/{division}/dean-office',             [EducationController::class, 'deanOffice'])
                                                            ->whereIn('type', ['faculty'])
                                                            ->name('division.education.dean-office');

Route::get('{type}/{division}/teaching-staff',          [EducationController::class, 'teachingStaff'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('division.education.teaching-staff');


Route::get('{type}/{division}/departments',             [EducationController::class, 'departments'])
                                                            ->whereIn('type', ['institute','faculty','department'])
                                                            ->name('division.education.departments');

Route::get('{type}/{division}/specialities',            [EducationController::class, 'specialities'])
                                                            ->whereIn('type', ['institute','faculty','department'])
                                                            ->name('division.education.specialities');

Route::get('{type}/{division}/partners',                [EducationController::class, 'partners'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('division.education.partners');

Route::get('{type}/{division}/sciences',                [EducationController::class, 'sciences'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('division.education.sciences');

Route::get('{type}/{division}/documents',               [EducationController::class, 'documents'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('division.education.documents');

Route::get('{type}/{division}/gallery',                 [EducationController::class, 'gallery'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('division.education.gallery');

Route::get('{type}/{division}/{section?}/{item?}',      [EducationController::class, 'division'])
                                                            ->whereIn('type', [
                                                                'institute',
                                                                'faculty',
                                                                'department',
                                                                'lab',
                                                                'science-lab',
                                                                'education-lab',
                                                                'branch'
                                                            ])
                                                            ->name('public:education:division');

Route::get('departments',                               [EducationController::class, 'showAllDepartments'])
                                                            ->name('public:education:departments:list');

Route::get('branches',                                  [EducationController::class, 'showAllBranch'])
                                                            ->name('public:education:branch:list');

/* Divisions: public */

Route::get('divisions',                                 [DivisionController::class,'publicList'])
                                                            ->name('public:division:list');

Route::get('division/{division?}',                      [DivisionController::class,'show'])
                                                            ->name('public:division:show');

Route::get('rectorate',                                 [DivisionController::class,'show'])
                                                            ->setDefaults(['division'=>'rectorate']);

/* Compilation */

Route::get('science-labs',                              [DivisionCompilationController::class, 'scienceLabs'])
                                                            ->name('public.science-labs.list');

Route::get('education-labs',                            [DivisionCompilationController::class, 'educationLabs'])
                                                            ->name('public.education-labs.list');

Route::get('educational-infrastructure',                [DivisionCompilationController::class, 'educationalInfrastructure']);
