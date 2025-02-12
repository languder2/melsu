<?php

use App\Http\Controllers\{
    AdminController,
    NewsController,
    suStructureController
};
use App\Http\Controllers\{
    MenuController,
    MenuItemsController,
    PagesController
};
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Education\{
    DepartmentController as EducationDepartmentController,
    FacultyController,
    SpecialityController
};
use App\Http\Controllers\EventsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.check')
    ->controller(suStructureController::class)
    ->prefix('structure')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:structure');
        Route::get('add', 'form')->name('admin:structure:add');
        Route::get('edit/{id}', 'form')->name('admin:structure:edit');
        Route::post('save', 'save')->name('admin:structure:save');
        Route::get('delete/{id}', 'delete')->name('admin:structure:delete');

    });

/* News: admin */

Route::middleware('auth.check')
    ->controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:news');
        Route::get('add', 'form')->name('admin:news:add');
        Route::get('edit/{id}', 'form')->name('admin:news:edit');
        Route::post('save', 'save')->name('admin:news:save');
        Route::get('delete/{id}', 'delete')->name('admin:news:delete');

    });

/* Events: admin */

Route::middleware('auth.check')
    ->controller(EventsController::class)
    ->prefix('events')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:events');
        Route::get('add', 'form')->name('admin:events:add');
        Route::get('edit/{id}', 'form')->name('admin:events:edit');
        Route::post('save', 'save')->name('admin:events:save');
        Route::get('delete/{id}', 'delete')->name('admin:events:delete');

    });

Route::middleware('auth.check')
    ->controller(MenuItemsController::class)
    ->prefix('menu-items')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu-items');
        Route::get('add', 'form')->name('admin:menu-items:add');
        Route::get('edit/{id}', 'form')->name('admin:menu-items:edit');
        Route::post('save', 'save')->name('admin:menu-items:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu-items:delete');

    });

Route::middleware('auth.check')
    ->controller(MenuController::class)
    ->prefix('menu')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu');
        Route::get('add', 'form')->name('admin:menu:add');
        Route::get('edit/{id}', 'form')->name('admin:menu:edit');
        Route::post('save', 'save')->name('admin:menu:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu:delete');

    });

Route::middleware('auth.check')
    ->controller(PagesController::class)
    ->prefix('pages')
    ->group(function () {

        Route::get('', 'list')->name('admin:pages');
        Route::get('add', 'form')->name('admin:pages:add');
        Route::get('edit/{id}', 'form')->name('admin:pages:edit');
        Route::post('save', 'save')->name('admin:pages:save');
        Route::get('delete/{id}', 'delete')->name('admin:pages:delete');

    });


Route::middleware('auth.check')
    ->controller(StaffController::class)
    ->prefix('staff')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:staff');
        Route::get('works/add-line', function () {
        })->name('admin:staff:works:add-line');
        Route::get('works/add-line/{i}', 'worksAddLine')->name('admin:staff:works:add-line-num');
        Route::get('add', 'form')->name('admin:staff:add');
        Route::get('edit/{id}', 'form')->name('admin:staff:edit');
        Route::post('save', 'save')->name('admin:staff:save');
        Route::get('delete/{id}', 'delete')->name('admin:staff:delete');

    });

Route::middleware('auth.check')
    ->controller(UserController::class)
    ->prefix('users')
    ->group(function () {
        Route::get('add', 'add')->name('admin:user:add');
    });

Route::middleware('auth.check')
    ->controller(DepartmentController::class)
    ->prefix('department')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:department');

        Route::get('contents/add', function () {
        })->name('admin:department:content:add');
        Route::get('contents/add/{i}', 'addContentSection');

        Route::get('staff/add', function () {
        })->name('admin:department:staff:add');
        Route::get('staff/add/{i}', 'addStaff');

        Route::get('document/add', function () {
        })->name('admin:department:document:add');
        Route::get('document/add/{i}', 'addDocument2Form');

        Route::get('add', 'form')->name('admin:department:add');
        Route::get('edit/{id}', 'form')->name('admin:department:edit');
        Route::post('save', 'save')->name('admin:department:save');
        Route::get('delete/{id}', 'delete')->name('admin:department:delete');

    });


Route::middleware('auth.check')
    ->controller(FacultyController::class)
    ->prefix('faculties')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-faculty:list');
        Route::get('add', 'form')->name('admin:education-faculty:add');
        Route::get('edit/{id}', 'form')->name('admin:education-faculty:edit');
        Route::post('save', 'save')->name('admin:education-faculty:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-faculty:delete');

    });

Route::middleware('auth.check')
    ->controller(EducationDepartmentController::class)
    ->prefix('departments')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-department:list');
        Route::get('add', 'form')->name('admin:education-department:add');
        Route::get('edit/{id}', 'form')->name('admin:education-department:edit');
        Route::post('save', 'save')->name('admin:education-department:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-department:delete');

    });

Route::middleware('auth.check')
    ->controller(SpecialityController::class)
    ->prefix('specialities')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-speciality:list');
        Route::get('add', 'form')->name('admin:education-speciality:add');
        Route::get('edit/{id}', 'form')->name('admin:education-speciality:edit');
        Route::post('save', 'save')->name('admin:education-speciality:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-speciality:delete');

    });

Route::middleware('auth.check')
    ->controller(\App\Http\Controllers\Gallery\AdminImageGallery::class)
    ->prefix('gallery/images')
    ->group(function () {
        Route::get('', 'list')->name('admin:gallery:image:list');
        Route::get('form/{id?}', 'list')->name('admin:gallery:image:form');
    });


Route::middleware('auth.check')
    ->controller(\App\Http\Controllers\Gallery\AdminVideoGallery::class)
    ->prefix('gallery/videos')
    ->group(function () {
        Route::get('', 'list')->name('admin:gallery:video:list');
    });


