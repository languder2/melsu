<?php

use App\Http\Controllers\Gallery\AdminImageGallery;
use App\Http\Controllers\Staffs\StaffController;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

    $menu = new \App\Models\Menu\Item();

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

Route::middleware(['web','auth.api'])->prefix('posts')->group(function () {
//Route::prefix('posts')->group(function () {
    Route::get('delete/{id?}', [StaffController::class, 'ApiDelete'])
    ->name('api-post-delete');

    Route::view('add-section', "components.admin.staff.post",[
        "i"         => microtime(),
        'post'      => null
    ])
    ->name('api-post-add-section');
});


Route::middleware(['web','auth.api'])
    ->controller(\App\Http\Controllers\Department\GroupController::class)
    ->prefix('department-groups')
    ->group(function () {
        Route::get('delete/{id?}', 'ApiDelete')->name('api:department-groups:delete');

        Route::get('toggle-show/{id}', 'ApiToggleShow')
            ->name('api:department-groups:toggle-show');


    });


Route::middleware(['web','auth.api'])
    ->controller(\App\Http\Controllers\Department\DepartmentController::class)
    ->prefix('departments')
    ->group(function () {
//        Route::get('delete/{id?}', 'ApiVacattePosition')->name('api:department-groups:delete');

        Route::get('vacate-position/{affiliation_id?}', 'ApiVacatePosition')
            ->name('api:department:staff:vacate-position');

        Route::get('staff-add-position', function(){
            return View::make('components.staff.select-with-post')->with([
                'id' => (int)microtime(true ),
            ])->render();
        })
            ->name('api:department:staff:add-position');


    });


Route::middleware(['web','auth.api'])
    ->controller(\App\Http\Controllers\Menu\ItemsController::class)
    ->prefix('menu')
    ->group(function () {

        Route::get('get-parents-for-menu/{menu?}/{id?}', function($menu = null,$id = null){

            return \App\Models\Menu\Item::where('menu_id',$menu)
                ->where('id','!=',$id)
                ->whereNull('parent_id')
                ->select('name','id')
                ->orderBy('name')
                ->get();

        })->name('api:menu-items:parents:get');


        Route::get('staff-add-position', function(){
            return View::make('components.staff.select-with-post')->with([
                'id' => (int)microtime(true ),
            ])->render();
        })
            ->name('api:department:staff:add-position');


    });


