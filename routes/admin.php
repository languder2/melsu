<?php

use App\Http\Controllers\Division\DivisionController;
use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\Education\{DepartmentController, FacultyController, LabsController, };
use App\Http\Controllers\Handbook\HandbookController;
use App\Http\Controllers\Menu\{ItemsController as MenuItems, MenuController};
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Minor\MinorController;
use App\Http\Controllers\TestController;



Route::controller(MenuItems::class)
    ->prefix('menu/items')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu-items');
        Route::get('add', 'form')->name('admin:menu-items:add');
        Route::get('edit/{id}', 'form')->name('admin:menu-items:edit');
        Route::post('save', 'save')->name('admin:menu-items:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu-items:delete');

    });

Route::controller(MenuController::class)
    ->prefix('menu/list')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu');
        Route::get('add', 'form')->name('admin:menu:add');
        Route::get('edit/{id}', 'form')->name('admin:menu:edit');
        Route::post('save', 'save')->name('admin:menu:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu:delete');

    });

Route::controller(PagesController::class)
    ->prefix('pages')
    ->group(function () {

        Route::get('', 'list')->name('admin:pages');
        Route::get('add', 'form')->name('admin:pages:add');
        Route::get('edit/{id}', 'form')->name('admin:pages:edit');
        Route::post('save', 'save')->name('admin:pages:save');
        Route::get('delete/{id}', 'delete')->name('admin:pages:delete');

    });


Route::controller(StaffController::class)
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

Route::prefix('users')->group(function () {
    Route::get('',              [UserController::class,'list'])->name('admin:users:list');
    Route::get('add',           [UserController::class,'form'])->name('admin:users:add');
    Route::get('edit/{user}',   [UserController::class,'form'])->name('admin:users:edit');
    Route::post('save',         [UserController::class,'save'])->name('admin:users:save');
    Route::get('delete/{user}', [UserController::class,'delete'])->name('admin:users:delete');
});

Route::controller(FacultyController::class)
    ->prefix('faculties')
    ->group(function () {

        Route::get('', 'list')->name('admin:faculty:list');

    });



Route::controller(DepartmentController::class)
    ->prefix('departments')
    ->group(function () {

        Route::get('', 'list')->name('admin:department:list');

    });

/* Labs */

Route::controller(LabsController::class)
    ->prefix('education/labs')
    ->group(function () {
        Route::get('', 'AdminList')->name('admin:lab:list');

    });

Route::controller(\App\Http\Controllers\Gallery\AdminImage::class)
    ->prefix('images')
    ->group(function () {
        Route::get('', 'list')->name('admin:image:list');
        Route::get('form/{id?}', 'form')->name('admin:image:form');
        Route::post('save', 'save')->name('admin:image:save');
    });

Route::controller(\App\Http\Controllers\Gallery\AdminVideoGallery::class)
    ->prefix('gallery/videos')
    ->group(function () {
        Route::get('', 'list')->name('admin:gallery:video:list');
    });

/**/

Route::controller(\App\Http\Controllers\ImportController::class)
    ->prefix('imports')
    ->group(function () {
        Route::get('departments',"DepartmentsGetFile")
            ->name('imports:departments:get');
        Route::post('departments/update',"DepartmentsUpdate")
            ->name('imports:departments:update');
    });

/*schedule*/

Route::prefix('schedule')
    ->group(function () {

        Route::get('/', [ScheduleController::class, 'showSchedulePage'])->name('schedule.page');
        Route::post('/import', [ScheduleController::class, 'importSchedule'])->name('schedule.import');
    });

/*handbook*/

Route::middleware('auth.check')
    ->prefix('handbook')
    ->group(function () {
        // Коллекции справочников
        Route::get('/', [HandbookController::class, 'indexCollections'])->name('handbook.collections');
        Route::get('collections/create', [HandbookController::class, 'createCollection'])->name('handbook.collections.create');
        Route::post('collections/store', [HandbookController::class, 'storeCollection'])->name('handbook.collections.store');
        Route::get('collections/edit/{id}', [HandbookController::class, 'editCollection'])->name('handbook.collections.edit');
        Route::put('collections/update/{id}', [HandbookController::class, 'updateCollection'])->name('handbook.collections.update');
        Route::get('collections/delete/{id}', [HandbookController::class, 'destroyCollection'])->name('handbook.collections.delete');

        // Справочники внутри коллекции
        Route::get('{collectionId}', [HandbookController::class, 'index'])->name('handbook.page');
        Route::get('{collectionId}/add', [HandbookController::class, 'create'])->name('handbook.create');
        Route::post('{collectionId}/store', [HandbookController::class, 'store'])->name('handbook.store');
        Route::get('{collectionId}/edit/{id}', [HandbookController::class, 'edit'])->name('handbook.edit');
        Route::put('{collectionId}/update/{id}', [HandbookController::class, 'update'])->name('handbook.update');
        Route::get('{collectionId}/delete/{id}', [HandbookController::class, 'destroy'])->name('handbook.delete');
    });

/* Regiment / Научный и Бессмертный полк */
Route::get('minors',[MinorController::class,'index'])->name("minors:admin:index");

/**/

Route::get('test',[TestController::class,'admin']);

/*history*/
Route::middleware('auth.check')
    ->prefix('history')
    ->group(function () {
        Route::get('/list', [HistoryController::class, 'index'])->name('history');
        Route::get('/create', [HistoryController::class, 'create'])->name('history.create');
        Route::post('/store', [HistoryController::class, 'store'])->name('history.store');
        Route::get('/edit/{id}', [HistoryController::class, 'edit'])->name('history.edit');
        Route::put('/update/{id}', [HistoryController::class, 'update'])->name('history.update');
        Route::get('/delete/{id}', [HistoryController::class, 'destroy'])->name('history.delete');
    });

