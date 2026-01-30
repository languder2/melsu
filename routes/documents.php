<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocumentCategoriesController;
use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Controllers\Documents\RelationCategoriesController;
use App\Http\Middleware\AuthCabinet;

Route::prefix('admin/document-categories')->group(function(){
    Route::get('form/{category?}',      [DocumentCategoriesController::class,'form'])->name('document-categories:admin:form');
    Route::put('save/{category?}',      [DocumentCategoriesController::class,'save'])->name('document-categories:save');

    Route::get('delete/{category?}',    [DocumentCategoriesController::class,'delete'])->name('document-categories:delete');

    Route::get('{field?}/{direction?}', [DocumentCategoriesController::class,'admin'])->setDefaults(['field' => 'sort', 'direction' => 'asc'])->name('document-categories:admin:list');
});

Route::prefix('admin/documents')->group(function(){
    Route::get('form/{document?}',      [DocumentsController::class,'form'])    ->name('documents:admin:form');
    Route::post('save/{document?}',     [DocumentsController::class,'save'])    ->name('documents:admin:save');
    Route::get('delete/{document?}',    [DocumentsController::class,'delete'])  ->name('documents:delete');
    Route::get('{field?}/{direction?}', [DocumentsController::class,'admin'])
        ->setDefaults(['field' => 'sort', 'direction' => 'asc'])
        ->name('documents:admin:list');
});

Route::get('documents',                 [DocumentsController::class,'public'])  ->name('documents:public:list');

/* API */
Route::middleware(['web','auth.api'])->prefix('api/documents')->group(function () {
    Route::get('add-block',             [DocumentsController::class,'ApiAddBlock'])
        ->name('documents:api:add-block');

    Route::get('add-block-speciality',  [DocumentsController::class,'ApiAddBlockSpeciality'])
        ->name('documents:api:add-block:speciality');

    Route::get('delete/{item?}', [DocumentsController::class,'ApiDelete'])->name('documents:api:delete');
});

/* Relation Documents Categories*/

Route::prefix('cabinet/documents/{entity}/{entity_id}/')->middleware(AuthCabinet::class)->group(function () {
    Route::get('',                                         [RelationCategoriesController::class, 'list'])
                                                                ->name('documents.relation.list');

    Route::get('on-approval',                               [RelationCategoriesController::class, 'onApproval'])
                                                                ->name('documents-category.relation.on-approval');

    Route::get('form/{category?}',                          [RelationCategoriesController::class, 'form'])
                                                                ->name('documents-category.relation.form');

    Route::put('save/{category?}',                          [RelationCategoriesController::class, 'save'])
                                                                ->name('documents-category.relation.save');

    Route::delete('delete/{category?}',                     [RelationCategoriesController::class, 'delete'])
                                                                ->name('documents-category.relation.delete');

    Route::get('change-sort/{category}/{direction}',        [RelationCategoriesController::class, 'changeSort'])
                                                                ->name('documents-categories.cabinet.change-sort')
                                                                ->defaults('direction', 'down');
});

