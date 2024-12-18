<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,suStrucureController};

use App\Models\suStructure;

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
->prefix('structure')
->group(function () {

    Route::get('', 'adminList')->name('admin:structure');
    Route::get('add', 'adminAdd')->name('admin:structure:add');

});



