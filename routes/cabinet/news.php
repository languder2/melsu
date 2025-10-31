<?php

use App\Http\Controllers\News\CabinetNewsController;
use Illuminate\Support\Facades\Route;

Route::get('', [CabinetNewsController::class, 'list'])->name('cabinet.news.list');
Route::get('on-approval', [CabinetNewsController::class, 'onApproval'])->name('news.cabinet.onApproval');
