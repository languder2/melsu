<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\UserRoles;
use App\Jobs\SendEmailJob;
use App\Models\Division\Division;
use App\Models\Documents\DocumentCategory;
use App\Models\Events\Category;
use App\Models\Events\Events;
use App\Models\Gallery\Image;
use App\Models\Minor\Career;
use App\Models\Minor\Contact;
use App\Models\Minor\Goals;
use App\Models\Minor\Graduation;
use App\Models\Minor\Science;
use App\Models\News\News;
use App\Models\Page\Page;
use App\Models\Partners\Partner;
use App\Models\Services\Content;
use App\Models\Users\Role;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        $list = collect();

        Division::whereNotNull('description')->get()->each(function($item){
            if($item->content('description')->exists) return;

            $json = json_decode($item->description);

            $content = is_null($json) ? rawTextToEditorJS($item->description) : $item->description;

            $item->setContent('description', $content);
        });

        dd();

        $json = Storage::get('json/get_employee.json');

        $list = collect(json_decode($json)->employee);

        $list = $list->filter(fn($item) =>
            $item->uid_department === 'fba3b2e9-a348-11f0-b9b6-f61497ae5d0c'
            || $item->surname === 'Болотов'
            || $item->surname === 'Слета'
            || $item->surname === 'Петровский'
            || $item->surname === 'Артюхов'
        )
            ->filter(fn($item) => !$item->dismissed)
            ->each(fn($item) => $item->date_birth = Carbon::parse($item->date_birth))
            ->sortBy('surname');

        return view('test.index',compact('list'));
    }

    public function test()
    {

        DocumentCategory::all()->each(fn($item) => Cache::forever(
            "documents-category-{$item->id}",
            view('documents.public.category', ['category' => $item])->render()
        ));

        dd();

        Division::whereNotNull('description')->get()->each(fn ($item)=> $item->content('description')->fill(['content' => rawTextToEditorJS($item->description)])->save());

        dd();

        $division   = Division::find(135);

        dd($division->documentCategories);
        return view('test.test', compact('item'));

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
