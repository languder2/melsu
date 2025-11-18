<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCabinet;
use App\Http\Controllers\Minor\ContactsController;

Route::prefix('cabinet/contacts/{entity}/{entity_id}/')
    ->middleware(AuthCabinet::class)
    ->group(function () {
        Route::get('/',                                     [ContactsController::class, 'list'])
                                                                ->name('contacts.cabinet.list');

        Route::get('form/{contact?}',                        [ContactsController::class, 'form'])
                                                                ->name('contacts.cabinet.form');

        Route::put('save/{contact?}',                        [ContactsController::class, 'save'])
                                                                ->name('contacts.cabinet.save');

        Route::delete('delete/{contact?}',                   [ContactsController::class, 'delete'])
                                                                ->name('contacts.cabinet.delete');

        Route::get('change-sort/{contact?}/{direction?}',    [ContactsController::class, 'changeSort'])
                                                                ->name('contacts.cabinet.change-sort')
                                                                ->defaults('direction', 'down');
});
