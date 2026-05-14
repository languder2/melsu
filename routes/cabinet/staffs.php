<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Staffs\CabinetStaffsController;
use App\Http\Controllers\Staffs\CabinetPostsController;

Route::middleware(AuthCabinet::class)->prefix('cabinet/staffs')->group(function () {
    Route::get('list', [CabinetStaffsController::class, 'list'])->name('cabinet.staffs.list');
});

