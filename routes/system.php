<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

Route::match(['get','post'],'import/finance/report',[ImportController::class,'financeReport'])
    ->name('import.finance.report');
