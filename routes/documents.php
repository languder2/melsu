<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Controllers\Documents\RelationCategoriesController;
use App\Http\Controllers\Documents\RelationDocumentsController;
use App\Http\Middleware\AuthCabinet;
use App\Http\Middleware\InstanceAccess;
use App\Http\Controllers\Documents\CabinetCategoriesController;

Route::get('documents',                 [DocumentsController::class,'public'])  ->name('documents:public:list');

/* Relation Documents Categories*/

Route::prefix('cabinet/documents-categories/{entity}/{entity_id}/')
    ->middleware([AuthCabinet::class, InstanceAccess::class])->group(function () {
        Route::get('',                                      [RelationCategoriesController::class, 'list'])
                                                                ->name('documents.relation.list');

        Route::get('on-approval',                           [RelationCategoriesController::class, 'onApproval'])
                                                                ->name('documents-category.relation.on-approval');

        Route::get('form/{category?}',                      [RelationCategoriesController::class, 'form'])
                                                                ->name('documents-category.relation.form');

        Route::put('save/{category?}',                      [RelationCategoriesController::class, 'save'])
                                                                ->name('documents-category.relation.save');

        Route::delete('delete/{category?}',                 [RelationCategoriesController::class, 'delete'])
                                                                ->name('documents-category.relation.delete');

        Route::get('change-sort/{category}/{direction}',    [RelationCategoriesController::class, 'changeSort'])
                                                                ->name('documents-categories.relation.change-sort')
                                                                ->defaults('direction', 'down');
});

/* Relation Documents */

Route::prefix('cabinet/documents/{entity}/{entity_id}/')->middleware([AuthCabinet::class, InstanceAccess::class])
    ->group(function () {

        Route::get('form/{document?}',                      [RelationDocumentsController::class, 'form'])
                                                                ->name('documents.relation.form');

        Route::put('save/{document?}',                      [RelationDocumentsController::class, 'save'])
                                                                ->name('documents.relation.save');
});

Route::prefix('cabinet/documents/')->middleware([AuthCabinet::class, InstanceAccess::class])
    ->group(function () {

        Route::delete('delete/{document?}',                 [RelationDocumentsController::class, 'delete'])
                                                                ->name('documents.relation.delete');

        Route::get('change-sort/{document}/{direction}',    [RelationDocumentsController::class, 'changeSort'])
                                                                ->name('documents.relation.change-sort')
                                                                ->defaults('direction', 'down');

        Route::get('',                                      [CabinetCategoriesController::class, 'list'])
                                                                ->name('documents-categories.cabinet.list');

    });
