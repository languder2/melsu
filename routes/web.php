<?php

use App\Http\Controllers\{News\NewsController, suStructureController};
use App\Http\Controllers\{AdminController, PagesController, ScheduleController};
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\Gallery\PublicGallery;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\MenuController;

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

Route::prefix('nomix')->group(function () {
    require __DIR__.'/nomix.php';
});

Route::get('test', [TestController::class, 'index'])->name('test');
Route::post('test/save', [TestController::class, 'save'])->name('test:save');

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
    ->prefix('education')
    ->group(function () {
        Route::get('faculties', 'faculties')
            ->name('public:education:faculties');

        Route::get('departments', 'showAllDepartments')
            ->name('public:education:departments:list');

        Route::get('labs', 'showAllLabs')
            ->name('public:education:labs:list');

        Route::get('branch', 'showAllBranch')
            ->name('public:education:branch:list');
    });

Route::controller(EducationController::class)
    ->prefix('specialities')
    ->group(function () {
        Route::get('', 'specialities')->name('public:education:specialities:all');

        Route::get('{speciality}', 'speciality')->name('public:education:speciality');

    });

/* Education: public */

Route::controller(EducationController::class)
    ->prefix('education')
    ->group(function () {
        Route::get('{faculty?}', 'faculty')
            ->name('public:education:faculty');

        Route::get('{faculty}/departments', 'departments')
            ->name('public:education:departments');

        Route::get('{faculty}/staffs', 'staffs')
            ->name('public:education:staffs');

        Route::get('{faculty?}/specialities', 'specialities')
            ->name('public:education:specialities');

        Route::get('{faculty?}/{department?}', 'department')
            ->name('public:education:department');

        Route::get('{faculty}/{department}/specialities', 'specialities')
            ->name('public:education:specialities:department');
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

/* Gallery */

Route::controller(PublicGallery::class)
    ->prefix('gallery')
    ->group(function () {
        Route::get('', 'list')->name('public:gallery:list');
        Route::get('{code}', 'show')->name('public:gallery:show');

    });


/* Menu Page */
    Route::get('menu/{code?}', [MenuController::class,'show'])
        ->name('public:menu:show');


/* Pages */


Route::get('{alias}', [PagesController::class, 'showPage']);


/*Schedule*/

Route::controller(ScheduleController::class)
    ->prefix('schedule')
    ->group(function () {
        Route::get('/schedule',  'index')->name('public.schedule.index');
        Route::get('/get-groups', 'getGroups')->name('public.schedule.getGroups');
        Route::post('/schedule-result', 'updateSchedule')->name('public.schedule.updateSchedule');
    });
