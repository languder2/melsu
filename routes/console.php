<?php

use App\Models\Education\Profile;
use App\Models\Education\Speciality;

Schedule::call(function () {

    Cache::forget('eduAccred');

    Cache::rememberForever('eduAccred', fn() => Profile::eduAccred());

})->hourly();

Schedule::call(function () {

    Cache::forget('eduOp');

    Cache::rememberForever('eduOp', fn() => Profile::eduOp());

})->hourly();

Schedule::call(function () {

    Cache::forget('eduNir');

    Cache::rememberForever('eduNir', fn() => Speciality::eduNir());

})->hourly();

Schedule::call(function () {

    Cache::forget('graduateJob');

    Cache::rememberForever('graduateJob', fn() => Speciality::graduateJob());

})->hourly();
