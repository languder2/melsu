<?php

use App\Http\Controllers\{NewsController, suStructureController};
use App\Http\Controllers\{AdminController, PagesController};
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WishTreeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.main');
})->name('pages:main');

Route::view('admin', 'pages.admin')->name('admin:main');

Route::post('login', [AdminController::class, 'login'])->name('admin:login');

Route::get('exit', function () {
    auth()->logout();

    return redirect()->route('admin:main');

})->name('admin:logout');


Route::prefix('admin')->group(function () {
    require __DIR__.'/admin.php';
});

Route::view('wish-tree', 'pages.wish-tree.form')->name('wish-tree');
Route::post('wish-tree/save', [WishTreeController::class, 'save'])->name('wish-tree:save');
Route::get('wish-tree/list', [WishTreeController::class, 'list'])->name('wish-tree:list');

Route::get('test', [TestController::class, 'index']);

Route::controller(suStructureController::class)
    ->prefix('structure')
    ->group(function () {
        Route::get('', 'show')->name('structure:show');
    });


/* News: public */

Route::controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'showAll')->name('news:show:all');
        Route::get('show/{id}', 'show')->name('news:show');

    });

Route::controller(EducationController::class)
    ->prefix('specialities')
    ->group(function () {
        Route::get('', 'specialities')->name('public:education:specialities:all');

        Route::get('{speciality}', 'speciality')->name('public:education:speciality');

    });

/* Education: public */

Route::controller(EducationController::class)
    ->prefix('faculties')
    ->group(function () {

        Route::get('', 'faculties')
            ->name('public:education:faculties');

        Route::get('{faculty}/departments', 'departments')
            ->name('public:education:departments');

        Route::get('{faculty}/staffs', 'staffs')
            ->name('public:education:staffs');

        Route::get('{faculty?}/specialities', 'specialities')
            ->name('public:education:specialities');

        Route::get('{faculty}/{department}', 'department')
            ->name('public:education:department');

        Route::get('{faculty}/{department}/specialities', 'specialities')
            ->name('public:education:specialities:department');

        Route::get('{faculty}', 'faculty')
            ->name('public:education:faculty');

    });

/* Department: public */

Route::controller(DepartmentController::class)
    ->group(function () {
        Route::get('departments', 'showList')->name('public:department:list');
        Route::get('department/{code}', 'show')->name('public:department:show');
    });

/* Staffs: public */

Route::controller(StaffController::class)
    ->prefix('staffs')
    ->group(function () {
        Route::get('', 'list')->name('public:staff:list');
        Route::get('{code}', 'show')->name('public:staff:show');

    });

/* Pages: public */

Route::get('{alias}', [PagesController::class, 'showPage']);


