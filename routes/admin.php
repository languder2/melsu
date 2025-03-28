<?php

use App\Http\Controllers\Division\DivisionController;
use App\Http\Controllers\Education\{DepartmentController, FacultyController, LabsController, SpecialityController};
use App\Http\Controllers\Menu\{ItemsController as MenuItems, MenuController};
use App\Http\Controllers\News\EventsController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\suStructureController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth.check'])
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
    ->controller(MenuItems::class)
    ->prefix('menu/items')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu-items');
        Route::get('add', 'form')->name('admin:menu-items:add');
        Route::get('edit/{id}', 'form')->name('admin:menu-items:edit');
        Route::post('save', 'save')->name('admin:menu-items:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu-items:delete');

    });

Route::middleware('auth.check')
    ->controller(MenuController::class)
    ->prefix('menu/list')
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

        Route::post('set-filter', 'setFilter')->name('admin:staff:filter:set');



    });

Route::middleware('auth.check')
    ->controller(UserController::class)
    ->prefix('users')
    ->group(function () {
        Route::get('add', 'add')->name('admin:user:add');
    });

Route::middleware('auth.check')
    ->controller(DivisionController::class)
    ->prefix('divisions')
    ->group(function () {

        Route::get('add', 'form')->name('admin:division:add');
        Route::get('edit/{id}', 'form')->name('admin:division:edit');
        Route::post('save', 'save')->name('admin:division:save');
        Route::get('delete/{id}', 'delete')->name('admin:division:delete');

        Route::get('{group?}', 'adminList')->name('admin:division:list');
    });

Route::middleware('auth.check')
    ->controller(FacultyController::class)
    ->prefix('faculties')
    ->group(function () {

        Route::get('', 'list')->name('admin:faculty:list');

    });

Route::middleware('auth.check')
    ->controller(DepartmentController::class)
    ->prefix('departments')
    ->group(function () {

        Route::get('', 'list')->name('admin:department:list');

    });

/* Labs */

Route::middleware('auth.check')
    ->controller(LabsController::class)
    ->prefix('education/labs')
    ->group(function () {

        Route::get('', 'AdminList')->name('admin:lab:list');

    });


Route::middleware('auth.check')
    ->controller(SpecialityController::class)
    ->prefix('specialities')
    ->group(function () {

        Route::get('', 'list')->name('admin:speciality:list');
        Route::get('add', 'form')->name('admin:speciality:add');
        Route::get('edit/{id}', 'form')->name('admin:speciality:edit');
        Route::post('save', 'save')->name('admin:speciality:save');
        Route::get('delete/{id}', 'delete')->name('admin:speciality:delete');

    });

Route::middleware('auth.check')
    ->controller(\App\Http\Controllers\Gallery\AdminImageGallery::class)
    ->prefix('gallery/images')
    ->group(function () {
        Route::get('', 'list')->name('admin:gallery:image:list');
        Route::get('form/{id?}', 'form')->name('admin:gallery:image:form');
        Route::post('save', 'save')->name('admin:gallery:image:save');
    });

Route::middleware('auth.check')
    ->controller(\App\Http\Controllers\Gallery\AdminImage::class)
    ->prefix('images')
    ->group(function () {
        Route::get('', 'list')->name('admin:image:list');
        Route::get('form/{id?}', 'form')->name('admin:image:form');
        Route::post('save', 'save')->name('admin:image:save');
    });

Route::middleware('auth.check')
    ->controller(\App\Http\Controllers\Gallery\AdminVideoGallery::class)
    ->prefix('gallery/videos')
    ->group(function () {
        Route::get('', 'list')->name('admin:gallery:video:list');
    });

/**/

Route::
    controller(\App\Http\Controllers\ImportController::class)
    ->prefix('imports')
    ->group(function () {
        Route::get('departments',"DepartmentsGetFile")
            ->name('imports:departments:get');
        Route::post('departments/update',"DepartmentsUpdate")
            ->name('imports:departments:update');
    });

/*schedule*/

Route::middleware('auth.check')
    ->prefix('schedule')
    ->group(function () {

        Route::get('/', [ScheduleController::class, 'showSchedulePage'])->name('schedule.page');
        Route::post('/import', [ScheduleController::class, 'importSchedule'])->name('schedule.import');
    });
