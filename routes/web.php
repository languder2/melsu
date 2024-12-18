<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,suStrucureController,NewsController};

Route::get('/', function () {
    return view('pages.main');
})->name('pages:main');

Route::view('about-us', 'pages.about')->name('pages:about');



Route::view('admin', 'pages.admin')->name('admin:main');

Route::post('login', [AdminController::class, 'login'])->name('admin:login');

Route::get('exit', function (){

    auth()->logout();
    return redirect()->route('admin:main');

})->name('admin:logout');


Route::middleware('auth.check')
    ->controller(suStrucureController::class)
    ->prefix('admin/structure')
    ->group(function () {

        Route::get('', 'adminList')->name('admin:structure');
        Route::get('add', 'form')->name('admin:structure:add');
        Route::get('edit/{id}', 'form')->name('admin:structure:edit');
        Route::post('save', 'save')->name('admin:structure:save');
        Route::get('delete/{id}', 'delete')->name('admin:structure:delete');

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



