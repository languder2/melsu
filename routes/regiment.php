<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Minor\RegimentController;

Route::prefix('admin/regiment')->group(function(){
    Route::get('',                      [RegimentController::class,'admin'])    ->name('regiment:admin:list');
    Route::get('form/{member?}',        [RegimentController::class,'form'])     ->name('regiment:admin:form');
    Route::post('save/{member?}',       [RegimentController::class,'save'])     ->name('regiment:admin:save');
    Route::get('delete/{member?}',      [RegimentController::class,'delete'])   ->name('regiment:delete');
});

Route::get('regiments/{type?}',         [RegimentController::class,'public'])
    ->setDefaults(['type'=>'Immortal'])->name('regiment:public:list');

