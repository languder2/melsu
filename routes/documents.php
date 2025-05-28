<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocumentCategoriesController;
use App\Http\Controllers\Documents\DocumentsController;

Route::prefix('admin/document-categories')->group(function(){
    Route::get('form/{category?}',      [DocumentCategoriesController::class,'form'])
        ->name('document-categories:admin:form');

    Route::post('save/{category?}',     [DocumentCategoriesController::class,'save'])
        ->name('document-categories:admin:save');

    Route::get('delete/{category?}',    [DocumentCategoriesController::class,'delete'])
        ->name('document-categories:delete');

    Route::get('{field?}/{direction?}', [DocumentCategoriesController::class,'admin'])
        ->setDefaults(['field' => 'sort', 'direction' => 'asc'])
        ->name('document-categories:admin:list');
});

Route::prefix('admin/documents')->group(function(){
    Route::get('form/{document?}',      [DocumentsController::class,'form'])    ->name('documents:admin:form');
    Route::post('save/{document?}',     [DocumentsController::class,'save'])    ->name('documents:admin:save');
    Route::get('delete/{document?}',    [DocumentsController::class,'delete'])  ->name('documents:delete');
    Route::get('{field?}/{direction?}', [DocumentsController::class,'admin'])
        ->setDefaults(['field' => 'sort', 'direction' => 'asc'])
        ->name('documents:admin:list');
});

Route::get('documents',             [DocumentsController::class,'public'])  ->name('documents:public:list');

/* API */
Route::middleware(['web','auth.api'])->prefix('api/documents')->group(function () {
    Route::get('add-block',             [DocumentsController::class,'ApiAddBlock'])
        ->name('documents:api:add-block');
    Route::get('add-block-speciality',  [DocumentsController::class,'ApiAddBlockSpeciality'])
        ->name('documents:api:add-block:speciality');

    Route::get('delete/{item?}', [DocumentsController::class,'ApiDelete'])->name('documents:api:delete');
});
