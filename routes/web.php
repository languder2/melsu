<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Gallery\PublicGallery;
use App\Http\Controllers\Handbook\HandbookController;
use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Staffs\StaffController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Services\ControlController;

Route::get('dissertaczionnyj-sovet', fn()=> redirect()->to('https://melsu.ru/storage/uploads/documents/jf6WAsu4bbeJU4nR8INsfV9EcDuYK04ew3oENorp.pdf'));

Route::get('/', function () {
    return view('pages.main');
})->name('pages:main');

Route::view('admin', 'pages.admin')->name('admin:main');

Route::post('login', [AdminController::class, 'login'])->name('admin:login');

Route::get('exit', function () {
    auth()->logout();

    return redirect()->route('admin:main');

})->name('admin:logout');

Route::prefix('admin')->group(function () { require __DIR__.'/admin.php'; });
Route::prefix('cabinet')->group(function () { require __DIR__.'/cabinet.php'; });
Route::prefix('nomix')->group(function () { require __DIR__.'/nomix.php'; });

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
    Route::get('menu/projects',fn() => redirect()->route('clusters.list'));

    Route::get('menu/{code?}', [MenuController::class,'show'])
        ->name('public:menu:show');

/*Schedule*/

Route::controller(ScheduleController::class)
    ->prefix('schedule')
    ->group(function () {
        Route::get('show',  'index')->name('public.schedule.index');
        Route::get('get-groups', 'getGroups')->name('public.schedule.getGroups');
        Route::post('schedule-result', 'updateSchedule')->name('public.schedule.updateSchedule');
    });

/*handbook*/
Route::get('/handbooks/{collectionId}', [HandbookController::class, 'show'])->name('public.handbooks.show');

Route::get('control/sections',  [ControlController::class,'sections']);
Route::get('control/contacts',  [ControlController::class,'contacts']);
Route::get('control/staffs',    [ControlController::class,'staffs']);

/* Pages */

Route::get('/history', [HistoryController::class, 'indexPage'])->name('public.history.index');

require __DIR__.'/test.php';
require __DIR__.'/info.php';
require __DIR__.'/regiment.php';
require __DIR__.'/divisions.php';
require __DIR__.'/documents.php';
require __DIR__.'/news.php';
require __DIR__.'/projects.php';
require __DIR__.'/partners.php';
require __DIR__.'/education.php';
require __DIR__.'/gallery.php';
require __DIR__.'/goals.php';
require __DIR__.'/careers.php';
require __DIR__.'/science.php';
require __DIR__.'/contacts.php';
require __DIR__.'/graduations.php';
require __DIR__.'/users.php';

require __DIR__.'/system.php';
require __DIR__.'/pages.php';
