<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocumentCategoriesController;
use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Controllers\Documents\RelationDocumentsController;
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


Route::get('admin/documents/relation/{model}/{id}/category/form/{category?}',   [RelationDocumentsController::class, 'formCategory'])->name('relation:document:categories:admin:form');
Route::get('admin/documents/relation/{model}/{id}/',                            [RelationDocumentsController::class, 'admin'])->name('relation:documents:admin');

Route::put('admin/document-categories/save/{category?}',      [DocumentCategoriesController::class,'save'])->name('document_categories:save');


Route::prefix('cabinet/documents/{entity}/{entity_id}/')->middleware(AuthCabinet::class)->group(function () {
    Route::get('/',                         [RelationDocumentsController::class, 'cabinet'])->name('documents.cabinet.list');

//    Route::get('form/{document?}',              [RelationDocumentsController::class, 'form'])->name('goals.cabinet.form');
//    Route::put('save/{goal?}',              [GoalsController::class, 'save'])->name('goals.cabinet.save');
//    Route::delete('delete/{goal?}',         [GoalsController::class, 'delete'])->name('goals.cabinet.delete');
//    Route::get('change-sort/{goal?}/{direction?}',
//        [GoalsController::class, 'changeSort'])->name('goals.cabinet.change-sort')->defaults('direction', 'down');
});
