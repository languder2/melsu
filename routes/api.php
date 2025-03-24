<?php

use App\Http\Controllers\Gallery\AdminImageGallery;
use App\Http\Controllers\Staffs\StaffController;
use App\Models\Division\Division;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Sections\FAQController;

Route::get('departments-by-faculty-shorts/{faculty?}', function (Request $request, $faculty = null) {

    if (is_null($faculty))
        return Division::orderBy('name')->get()->pluck('name', 'code')->toJson(JSON_UNESCAPED_UNICODE);
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
    ->prefix('content/sections')
    ->group(function () {
//        Route::get('delete/{id?}', 'ApiDelete')->name('api:department-groups:delete');

        Route::get('add', function (){
            return view('admin.page.content.editor')
                ->with([
                    'id'        => (int)microtime(true),
                    'section'   => null,
                    'content'   => true
                ]);
        })->name('api:content:sections:add');
    });

Route::middleware(['web','auth.api'])
    ->controller(FAQController::class)
    ->group(function () {
        Route::get('faq/add', [FAQController::class,'ApiAdd'])->name('api:faq:add');
        Route::get('faq/delete/{item?}', [FAQController::class,'ApiDelete'])->name('api:faq:delete');
    });


Route::controller(\App\Http\Controllers\Division\DivisionController::class)
    ->prefix('divisions')
    ->group(function () {

        Route::middleware(['web','auth.api'])->group(function () {
            Route::get('vacate-position/{affiliation_id?}', 'ApiVacatePosition')
                ->name('api:department:staff:vacate-position');

            Route::get('staff-add-position', function(){
                return View::make('components.staff.select-with-post')->with([
                    'id' => (int)microtime(true ),
                ])->render();
            })->name('api:division:staff:add-position');
        });

        Route::post('get-search-result','PublicSearchResult')
            ->name('public:division:search');
        Route::get('get-search-result','PublicSearchResult');
    });

Route::controller(StaffController::class)->group(function () {
    Route::post('get-search-result','PublicSearchResult')
        ->name('public:staffs:search');
});



Route::middleware(['web','auth.api'])
    ->controller(\App\Http\Controllers\PagesController::class)
    ->prefix('page/contents')
    ->group(function () {
        Route::get('delete/{id?}', 'ApiDeleteSection')->name('api:page:contents:section:delete');

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


Route::get('correct/page-menu-link', function(Request $request){
        $list = \App\Models\Menu\Item::whereNotNull('page_id')->get();

        foreach ($list as $item){
            if(!$item->LinkedPage->menu_id) continue;
            $item->LinkedPage->fill(['menu_id'=>$item->menu_id])->save();
        }

        return response()->json('success');
});

Route::post('set-filter-for-education-departments', function(Request $request){
    $groupedItems = Division::orderBy('name');

    $faculty = $request->get('faculty');
    if($faculty)
        $groupedItems = $groupedItems->where('faculty_code', $faculty);

    $search = $request->get('search');

    if ($search)
        $groupedItems = $groupedItems->whereLike('name', "%$search%");

    $groupedItems= $groupedItems->get()->groupBy(function ($item) {
        return strtoupper(mb_substr($item->name, 0, 1, 'UTF-8')); // Первая буква в верхнем регистре
    });

    return view("Public.Education.Departments.List",[
        'list'              => $groupedItems,
        'without_container' => true,
    ]);

})->name('public:education:departments:filter:set');


Route::prefix('contacts')
//Route::middleware(['web','auth.api'])->prefix('contacts')
    ->group(function () {
        Route::get('add-position/{type}/{contact?}', [ContactController::class, 'ApiAddPosition'])
        ->name('api:admin:contact:add-position');

        Route::get('delete/{id}', [ContactController::class, 'ApiDelete'])
            ->name('api:contact:delete');
    });



Route::get('correct',function(){
    $list = \App\Models\Page\Content::where('relation_type','App\Models\Department\Department')->get();


    foreach ($list as $item)
        $item->fill(['relation_type'=>'App\Models\Division\Division'])->save();

    $list = \App\Models\Staff\Affiliation::where('relation_type','App\Models\Department\Department')->get();

    foreach ($list as $item)
        $item->fill(['relation_type'=>'App\Models\Division\Division'])->save();

});

Route::get('set-score',[\App\Http\Controllers\ImportController::class,'setScores']);
