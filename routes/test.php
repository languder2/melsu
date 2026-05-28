<?php

use Illuminate\Support\Facades\Route;

Route::get('test/index', function(){
    return view('test.index');
});

