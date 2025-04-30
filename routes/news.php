<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\EventsController;

/* News */
Route::controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'showAll')->name('news:show:all');
        Route::get('show/{id}', 'show')->name('news:show');

    });

Route::middleware('isAdmin')
    ->controller(NewsController::class)
    ->prefix('admin/news')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:news');
        Route::get('add', 'form')->name('admin:news:add');
        Route::get('edit/{id}', 'form')->name('admin:news:edit');
        Route::post('save', 'save')->name('admin:news:save');
        Route::get('delete/{id}', 'delete')->name('admin:news:delete');

    });


/* NEWS API */

Route::middleware(['web','auth.api'])->group(function () {
    Route::get('api/news/add-section',  [NewsController::class,'ApiAddSection'])->name('news:api:add');
    Route::get('api/news/delete',       [NewsController::class,'ApiDelete'])    ->name('news:api:delete');
});

/* Events */

Route::get('events', [EventsController::class,'all'])->name('public:events:list');
Route::get('event/{event?}', [EventsController::class,'show'])->name('public:event:show');


Route::middleware('isAdmin')
    ->controller(EventsController::class)
    ->prefix('admin/events')
    ->group(function () {

        Route::get('', 'list')->name('admin:events');
        Route::get('add', 'form')->name('admin:events:add');
        Route::get('edit/{event?}', 'form')->name('admin:events:edit');
        Route::post('save/{event?}', 'save')->name('admin:events:save');
        Route::get('delete/{event?}', 'delete')->name('admin:events:delete');

    });
/**/

