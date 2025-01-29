<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,suStructureController,NewsController};
use App\Http\Controllers\EventsController;
use App\Http\Controllers\WishTreeController;
use App\Http\Controllers\{MenuItemsController,MenuController,PagesController};
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Education\{
    EducationController,
    FacultyController,
    DepartmentController as EducationDepartmentController,
    SpecialityController
};


Route::get('/', function () {
    return view('pages.main');
})->name('pages:main');

Route::view('wish-tree', 'pages.wish-tree.form')->name('wish-tree');
Route::post('wish-tree/save',  [WishTreeController::class, 'save'])->name('wish-tree:save');
Route::get('wish-tree/list',  [WishTreeController::class, 'list'])->name('wish-tree:list');


Route::get('test',  [TestController::class, 'index']);


Route::view('admin', 'pages.admin')->name('admin:main');

Route::post('login', [AdminController::class, 'login'])->name('admin:login');

Route::get('exit', function (){

    auth()->logout();
    return redirect()->route('admin:main');

})->name('admin:logout');

Route::middleware('auth.check')
    ->controller(suStructureController::class)
    ->prefix('admin/structure')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:structure');
        Route::get('add', 'form')->name('admin:structure:add');
        Route::get('edit/{id}', 'form')->name('admin:structure:edit');
        Route::post('save', 'save')->name('admin:structure:save');
        Route::get('delete/{id}', 'delete')->name('admin:structure:delete');

    });

Route::controller(suStructureController::class)
    ->prefix('structure')
    ->group(function () {
        Route::get('', 'show')->name('structure:show');
    });

Route::middleware('auth.check')
    ->controller(NewsController::class)
    ->prefix('admin/news')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:news');
        Route::get('add', 'form')->name('admin:news:add');
        Route::get('edit/{id}', 'form')->name('admin:news:edit');
        Route::post('save', 'save')->name('admin:news:save');
        Route::get('delete/{id}', 'delete')->name('admin:news:delete');

    });

Route::controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'showAll')->name('news:show:all');
        Route::get('show/{id}', 'show')->name('news:show');

    });

Route::middleware('auth.check')
    ->controller(EventsController::class)
    ->prefix('admin/events')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:events');
        Route::get('add', 'form')->name('admin:events:add');
        Route::get('edit/{id}', 'form')->name('admin:events:edit');
        Route::post('save', 'save')->name('admin:events:save');
        Route::get('delete/{id}', 'delete')->name('admin:events:delete');

    });

Route::middleware('auth.check')
    ->controller(MenuItemsController::class)
    ->prefix('admin/menu-items')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu-items');
        Route::get('add', 'form')->name('admin:menu-items:add');
        Route::get('edit/{id}', 'form')->name('admin:menu-items:edit');
        Route::post('save', 'save')->name('admin:menu-items:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu-items:delete');

    });

Route::middleware('auth.check')
    ->controller(MenuController::class)
    ->prefix('admin/menu')
    ->group(function () {

        Route::get('', 'list')->name('admin:menu');
        Route::get('add', 'form')->name('admin:menu:add');
        Route::get('edit/{id}', 'form')->name('admin:menu:edit');
        Route::post('save', 'save')->name('admin:menu:save');
        Route::get('delete/{id}', 'delete')->name('admin:menu:delete');

    });

Route::middleware('auth.check')
    ->controller(PagesController::class)
    ->prefix('admin/pages')
    ->group(function () {

        Route::get('', 'list')->name('admin:pages');
        Route::get('add', 'form')->name('admin:pages:add');
        Route::get('edit/{id}', 'form')->name('admin:pages:edit');
        Route::post('save', 'save')->name('admin:pages:save');
        Route::get('delete/{id}', 'delete')->name('admin:pages:delete');

    });


Route::middleware('auth.check')
    ->controller(StaffController::class)
    ->prefix('admin/staff')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:staff');
        Route::get('works/add-line', function(){})->name('admin:staff:works:add-line');
        Route::get('works/add-line/{i}', 'worksAddLine')->name('admin:staff:works:add-line-num');
        Route::get('add', 'form')->name('admin:staff:add');
        Route::get('edit/{id}', 'form')->name('admin:staff:edit');
        Route::post('save', 'save')->name('admin:staff:save');
        Route::get('delete/{id}', 'delete')->name('admin:staff:delete');

    });

Route::controller(StaffController::class)
    ->prefix('staff')
    ->group(function () {

        Route::get('{id}', 'show')->name('staff:show');

    });

Route::middleware('auth.check')
    ->controller(UserController::class)
    ->prefix('admin/users')
    ->group(function () {
        Route::get('add', 'add')->name('admin:user:add');
    });

Route::middleware('auth.check')
    ->controller(DepartmentController::class)
    ->prefix('admin/department')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:department');

        Route::get('contents/add', function(){})->name('admin:department:content:add');
        Route::get('contents/add/{i}', 'addContentSection');

        Route::get('staff/add', function(){})->name('admin:department:staff:add');
        Route::get('staff/add/{i}', 'addStaff');

        Route::get('document/add', function(){})->name('admin:department:document:add');
        Route::get('document/add/{i}', 'addDocument2Form');

        Route::get('add', 'form')->name('admin:department:add');
        Route::get('edit/{id}', 'form')->name('admin:department:edit');
        Route::post('save', 'save')->name('admin:department:save');
        Route::get('delete/{id}', 'delete')->name('admin:department:delete');

    });

Route::middleware('auth.check')
    ->controller(FacultyController::class)
    ->prefix('admin/faculties')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-faculty:list');
        Route::get('add', 'form')->name('admin:education-faculty:add');
        Route::get('edit/{id}', 'form')->name('admin:education-faculty:edit');
        Route::post('save', 'save')->name('admin:education-faculty:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-faculty:delete');

    });

Route::middleware('auth.check')
    ->controller(EducationDepartmentController::class)
    ->prefix('admin/departments')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-department:list');
        Route::get('add', 'form')->name('admin:education-department:add');
        Route::get('edit/{id}', 'form')->name('admin:education-department:edit');
        Route::post('save', 'save')->name('admin:education-department:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-department:delete');

    });

Route::middleware('auth.check')
    ->controller(SpecialityController::class)
    ->prefix('admin/specialities')
    ->group(function () {

        Route::get('', 'list')->name('admin:education-speciality:list');
        Route::get('add', 'form')->name('admin:education-speciality:add');
        Route::get('edit/{id}', 'form')->name('admin:education-speciality:edit');
        Route::post('save', 'save')->name('admin:education-speciality:save');
        Route::get('delete/{id}', 'delete')->name('admin:education-speciality:delete');

    });

Route::controller(StaffController::class)
    ->prefix('department')
    ->group(function () {
        Route::get('{id}', 'list')->name('department:show');
    });

Route::controller(EducationController::class)
    ->prefix('faculties')
    ->group(function () {

        Route::get('', 'faculties')
            ->name('public:education:faculties');

        Route::get('{faculty}/spec/{speciality}', 'speciality')
            ->name('public:education:speciality');

        Route::get('{faculty}/departments', 'departments')
            ->name('public:education:departments');

        Route::get('{faculty}/staffs', 'staffs')
            ->name('public:education:staffs');

        Route::get('{faculty}/specialities', 'specialities')
            ->name('public:education:specialities');

        Route::get('{faculty}/{department}', 'department')
            ->name('public:education:department');

        Route::get('{faculty}', 'faculty')
            ->name('public:education:faculty');

    });


Route::get('{alias}', [PagesController::class,'showPage']);
