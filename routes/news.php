<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\EventsController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\RelationNewsController;
use App\Http\Controllers\News\CabinetNewsController;
use App\Http\Controllers\News\CabinetEventsController;
use App\Http\Middleware\AuthCabinet;

/* News */
Route::controller(NewsController::class)
    ->prefix('news')
    ->group(function () {

        Route::get('', 'showAll')->name('news:show:all');
        Route::get('show/{id}', 'show')->name('news:show');

        Route::get('category/{category?}', [NewsController::class,'showAll'])->name('news-categories:public');

        Route::post('set-filter', [NewsController::class,'publicSetFilter'])->name('news:public:set-filter');
    });

Route::controller(NewsController::class)
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
    Route::get('api/news/add-section',  [NewsController::class,'ApiAddSection'])->name('news:api:add-section');
    Route::get('api/news/delete/{news?}',[NewsController::class,'ApiDelete'])    ->name('news:api:delete');
});

/* Events */

//Route::get('events', [EventsController::class,'all'])->name('public:events:list');
Route::get('event/{event?}', [EventsController::class,'show'])->name('public:event:show');


Route::controller(EventsController::class)
    ->prefix('admin/events')
    ->group(function () {

        Route::get('', 'list')->name('admin:events');
        Route::get('add', 'form')->name('admin:events:add');
        Route::get('edit/{event?}', 'form')->name('admin:events:edit');
        Route::post('save/{event?}', 'save')->name('admin:events:save');
        Route::get('delete/{event?}', 'delete')->name('admin:events:delete');

    });

    Route::get('/events', [EventsController::class, 'calendar'])->name('public:events:calendar');
    Route::get('/events/day/{date}', [EventsController::class, 'getDayEvents']);
/**/

/* Categories */

Route::prefix('admin/categories-news')->group(function () {
    Route::get('', [CategoriesController::class,'admin'])->name('news-categories:admin:list');
    Route::get('form/{category?}',  [CategoriesController::class,'form'])->name('news-categories:admin:form');
    Route::post('save/{category?}', [CategoriesController::class,'save'])->name('news-categories:save');
    Route::get('delete/{category?}',[CategoriesController::class,'delete'])->name('news-categories:delete');
});
/**/

Route::get('relation-news/{news?}', [RelationNewsController::class, 'show'])->name('news.relation.show');

/**/

Route::prefix('cabinet/news')->middleware(AuthCabinet::class)->group(function () {
    Route::get('',              [CabinetNewsController::class, 'list'])->name('news.cabinet.list');
    Route::post('set-filter',   [CabinetNewsController::class, 'setFilter'])->name('news.cabinet.set-filter');
    Route::get('form/{news?}',  [CabinetNewsController::class, 'form'])->name('news.cabinet.form');
    Route::put('save/{news?}',  [CabinetNewsController::class, 'save'])->name('news.cabinet.save');
    Route::delete('delete/{news?}',  [CabinetNewsController::class, 'delete'])->name('news.cabinet.delete');
    Route::get('on-approval', [CabinetNewsController::class, 'onApproval'])->name('news.cabinet.onApproval');

});

Route::prefix('cabinet/events')->middleware(AuthCabinet::class)->group(function () {
    Route::get('',              [CabinetEventsController::class, 'list'])->name('events.cabinet.list');
    Route::post('set-filter',   [CabinetEventsController::class, 'setFilter'])->name('events.cabinet.set-filter');
    Route::get('form/{event?}',  [CabinetEventsController::class, 'form'])->name('events.cabinet.form');
    Route::put('save/{event?}',  [CabinetEventsController::class, 'save'])->name('events.cabinet.save');
    Route::delete('delete/{event?}',  [CabinetEventsController::class, 'delete'])->name('events.cabinet.delete');
    Route::get('on-approval', [CabinetEventsController::class, 'onApproval'])->name('events.cabinet.onApproval');

});

