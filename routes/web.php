<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Division\DivisionController;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\Education\FacultyController;
use App\Http\Controllers\Education\SpecialityController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Gallery\PublicGallery;


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

/* News: public */

Route::controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'showAll')->name('news:show:all');
        Route::get('show/{id}', 'show')->name('news:show');

    });

Route::get('specialities', [SpecialityController::class,'showAll'])
    ->name('public:education:specialities:all');
Route::get('specialities/{speciality}', [SpecialityController::class,'showSingle'])
    ->name('public:education:speciality');


/* Faculties */


Route::get('faculties', [EducationController::class, 'faculties'])->name('public:education:faculties');

Route::get('{type}/{division}/{section?}',[EducationController::class, 'division'])
    ->whereIn('type', ['faculty', 'department','lab','branch'])
    ->name('public:education:division');


Route::get('departments', [EducationController::class, 'showAllDepartments'])
        ->name('public:education:departments:list');

Route::get('branches', [EducationController::class, 'showAllBranch'])
        ->name('public:education:branch:list');

Route::get('labs', [EducationController::class, 'showAllLabs'])
        ->name('public:labs:list');

/* Divisions: public */

Route::get('divisions', [DivisionController::class,'publicList'])->name('public:division:list');
Route::get('division/{code?}',[DivisionController::class,'show'])->name('public:division:show');
Route::get('rectorate',[DivisionController::class,'show'])->setDefaults(['code'=>'rectorate']);

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
        Route::get('/show',  'index')->name('public.schedule.index');
        Route::get('/get-groups', 'getGroups')->name('public.schedule.getGroups');
        Route::post('/schedule-result', 'updateSchedule')->name('public.schedule.updateSchedule');
    });
