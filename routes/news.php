<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\EventsController;
use App\Http\Controllers\News\CategoriesController;
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

Route::get('events', [EventsController::class,'all'])->name('public:events:list');
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

    Route::get('/events/calendar', [EventsController::class, 'calendar'])->name('public:events:calendar');
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

/* Relation News */



