<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\UserRoles;
use App\Jobs\SendEmailJob;
use App\Models\Division\Division;
use App\Models\Events\Category;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestController extends Controller
{
//    public function token()
//    {
//        dump(session()->token());
//    }
//
//    public function phpinfo():void
//    {

//        phpinfo();
//    }

    public function view()
    {
        $list = collect();

        if(auth()->check() && auth()->user()->isAdmin()){
            $list = Page::all();

            $list->each(function ($item) {
                $view = \Illuminate\Support\Facades\View::exists("pages/content/$item->view")
                    ? view("pages/content/$item->view")->render() : null;

                $sections = $item->sections->filter(fn($item) => $item->show)
                    ->sortBy('order')
                    ->map(fn($item) => ( $item->show_title ? "<h4>$item->title</h4>" : '') . $item->content);

                $content = rawTextToEditorJS(match (true){
                    !is_null($view) => $view,
                    $sections->IsNotEmpty() => $sections,
                    default => $item->getRawOriginal('content'),
                });

                $item->content_record->fill(['content' => $content])->save();
            });
        }

        return view('test.view',compact('list'));
    }

    public function index()
    {
        $list = collect();

//        News::all()->each(function ($item){
//            if($item->relation && $item->divisions->doesntContain($item->relation))
//                $item->divisions()->attach($item->relation);
//
//            if($item->category && $item->categories->doesntContain($item->category))
//                $item->categories()->attach($item->category);
//
//        });
//
//        Events::all()->each(function ($item){
//            if($item->relation && $item->divisions->doesntContain($item->relation))
//                $item->divisions()->attach($item->relation);
//
//            if($item->category && $item->categories->doesntContain($item->category))
//                $item->categories()->attach($item->category);
//
//        });

//        Page::all()->each(function($item){
//            $content = null;
//
//            $sections = $item->sections->each(
//                fn($item) => $item->content =
//                    $item->show_title ? "<h3>$item->title</h3> $item->content" : $item->content
//            );
//
//            if($sections->isNotEmpty())
//                $content = rawTextToEditorJS($sections->pluck('content'));
//
//            if($content && !$item->content_record->exists){
//                $item->content_record->fill(['content' => $content])->save();
//            }
//
//        });


        $json = Storage::get('json/get_employee.json');

        $list = collect(json_decode($json)->employee);

        $list = $list->filter(fn($item) =>
            $item->uid_department === 'fba3b2e9-a348-11f0-b9b6-f61497ae5d0c'
            || $item->surname === 'Болотов'
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

        \App\Models\News\Category::onlyTrashed()->get()->each(function ($category) {
            DB::table('news_relations')
                ->where('relation_id', $category->id)
                ->where('relation_type', $category::class)
                ->delete();

        });


    }

    public function pass():void
    {
        echo Str::uuid();

    }


}
