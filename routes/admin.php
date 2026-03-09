<?php

use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\Education\{DepartmentController, FacultyController, LabsController, };
use App\Http\Controllers\Menu\{ItemsController as MenuItems, MenuController};
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\Users\UsersController;
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
    Route::get('',              [UsersController::class,'list'])->name('admin:users:list');
    Route::get('add',           [UsersController::class,'form'])->name('admin:users:add');
    Route::get('edit/{user}',   [UsersController::class,'form'])->name('admin:users:edit');
    Route::post('save',         [UsersController::class,'save'])->name('admin:users:save');
    Route::get('delete/{user}', [UsersController::class,'delete'])->name('admin:users:delete');
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

