<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Education\Faculty;
use App\Models\Education\Department;

Route::get('departments-by-faculty-shorts/{faculty?}', function (Request $request,$faculty = null) {

    if(is_null($faculty))
        return Department::orderBy('name')->get()->pluck('name','code')->toJson(JSON_UNESCAPED_UNICODE);
    else
        return Faculty::where('code',$faculty)?->first()->departments->pluck('name','code')->toJson(JSON_UNESCAPED_UNICODE);
})->name('departments-by-faculty-shorts');
