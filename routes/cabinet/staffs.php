<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use Livewire\Volt\Volt;

Route::middleware(AuthCabinet::class)->prefix('cabinet/staffs')->group(function () {
    Volt::route('list', 'staffs.cabinet.list')->name('staffs.cabinet.list');
});

