<?php

use App\Models\Education\Department;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gallery\AdminImageGallery;
use App\Http\Controllers\StaffController;

Route::get('departments-by-faculty-shorts/{faculty?}', function (Request $request, $faculty = null) {

    if (is_null($faculty))
        return Department::orderBy('name')->get()->pluck('name', 'code')->toJson(JSON_UNESCAPED_UNICODE);
    else
        return Faculty::where('code', $faculty)?->first()->departments->pluck('name', 'code')->toJson(JSON_UNESCAPED_UNICODE);
})->name('departments-by-faculty-shorts');


Route::get('link-correct', function (Request $request) {

    $from = $request->get('from');
    $to = $request->get('to');

    if (!$from || !$to) return;

    $menu = new \App\Models\MenuItems();

    foreach ($menu::where('link', "!=", '')->get() as $item) {
        $item->link = str_replace($from, $to, $item->link);
        $item->save();
    }


});

Route::middleware(['web','auth.api'])->prefix('gallery')->group(function () {
    Route::get('toggle-show/{id}', [AdminImageGallery::class, 'ApiToggleShow'])
    ->name('gallery-toggle-show');

    Route::get('delete/{id}', [AdminImageGallery::class, 'ApiDelete'])
    ->name('gallery-delete');

});

//Route::middleware(['web','auth.api'])->prefix('posts')->group(function () {
Route::prefix('posts')->group(function () {
    Route::get('delete/{id?}', [StaffController::class, 'ApiDelete'])
    ->name('api-post-delete');

    Route::view('add-section', "components.admin.staff.post",[
        "i"         => microtime(),
        'post'      => null
    ])
    ->name('api-post-add-section');
});


