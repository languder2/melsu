<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Documents\CabinetDocumentsController;
use App\Models\Division\Division;
use App\Models\Documents\DocumentCategory;
use App\Models\Services\Log;
use App\Models\Staff\Staff;
use Carbon\Carbon;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TestController extends Controller
{
    public function view()
    {
        $list = collect();

//        if(auth()->check() && auth()->user()->isAdmin()){
//            $list = Page::all();
//
//            $list->each(function ($item) {
//                $view = \Illuminate\Support\Facades\View::exists("pages/content/$item->view")
//                    ? view("pages/content/$item->view")->render() : null;
//
//                $sections = $item->sections->filter(fn($item) => $item->show)
//                    ->sortBy('order')
//                    ->map(fn($item) => ( $item->show_title ? "<h4>$item->title</h4>" : '') . $item->content);
//
//                $content = rawTextToEditorJS(match (true){
//                    !is_null($view) => $view,
//                    $sections->IsNotEmpty() => $sections,
//                    default => $item->getRawOriginal('content'),
//                });
//
//                $item->content_record->fill(['content' => $content])->save();
//            });
//        }


        Division::limit(500)->get()->each(fn($division) =>
            $division->saveCacheCabinetItem()
        );


        return view('test.view',compact('list'));
    }

    public function index()
    {
        return view('test.index');
    }

    public function test()
    {
        return view('test.test');

    }

    public function uuid():void
    {

        $json = Storage::disk('private')->json('json/employee.json');

        if(is_null($json) || !array_key_exists('employee', $json))
            abort(404);

        $employees = collect($json['employee']);

        $grouped = $employees->groupBy('snils');
        $grouped2 = $employees->groupBy('uid_person');
        $grouped3 = $employees->groupBy('tab_number');

        dd(
            'EMPLOYEES',
            $employees,
            'SNILS',
            $grouped,
            'PERSONS',
            $grouped2,
            'TAB NUMBERS',
            $grouped3,
        );

    }
    public function pass():void
    {
        echo Str::uuid();

    }

    public function structure(): View
    {
        $json = Storage::get('json/get_departments.json');

        $list = collect(json_decode($json)->employee);

        return view('test.index',compact('list'));
    }


}
