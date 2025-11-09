<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('test/token',        [TestController::class, 'token']);
Route::get('test/php-info',     [TestController::class, 'phpinfo']);
Route::get('test/view',         [TestController::class,'view']);
Route::get('test/index',        [TestController::class,'index']);
Route::get('test/test',         [TestController::class,'test']);

