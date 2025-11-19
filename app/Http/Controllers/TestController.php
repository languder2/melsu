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
        /* Divisions */
//        Schema::disableForeignKeyConstraints();
//        $test = new Division();
//
//        $list = $test->setConnection('mirror')->where('type', DivisionType::Department)->get();
//
//        $list->each(function ($donor) {
//            $item = Division::where('id',$donor->id)->first();
//
//            if($item)
//
//                $item->fill($donor->toArray())->save();
//
//                $item->content('content')->fill($donor->content('content')->toArray())->save();
//
//                if($donor->content('history')->exists)
//                    $item->content('history')->fill($donor->content('history')->toArray())->save();
//
//                if($donor->content('gallery')->exists)
//                    $item->content('gallery')->fill($donor->content('gallery')->toArray())->save();
//
//                if($donor->content('achievements')->exists)
//                    $item->content('achievements')->fill($donor->content('achievements')->toArray())->save();
//        });
//
//
//        /* Contacts */
//
//        $test = new Contact();
//
//        $list = $test->setConnection('mirror')->get();
//
//        Contact::truncate();
//
//        $list->each(function ($donor) {
//
//            $item = Contact::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//        });
//
//        /* Goals */
//
//        Goals::truncate();
//
//        $test = new Goals();
//
//        $list = $test->setConnection('mirror')->get();
//
//        $list->each(function ($donor) {
//
//            $item = Goals::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//            $item->content('content')->fill($donor->content('content')->toArray())->save();
//
//        });
//
//
//        /* Science */
//
//        $test = new Science();
//
//        $list = $test->setConnection('mirror')->get();
//
//        Science::truncate();
//
//        $list->each(function ($donor) {
//
//            $item = Science::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//            $item->content('short')->fill($donor->content('short')->toArray())->save();
//            $item->content('content')->fill($donor->content('content')->toArray())->save();
//
//        });
//
//        /* Partners Category */
//
//        $test = new \App\Models\Partners\Category();
//
//        $list = $test->setConnection('mirror')->get();
//
//        \App\Models\Partners\Category::truncate();
//
//        $list->each(function ($donor) {
//
//            $item =  \App\Models\Partners\Category::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//        });
//
//        /* Partners */
//
//        $test = new Partner();
//
//        $list = $test->setConnection('mirror')->get();
//
//        Partner::truncate();
//
//        $list->each(function ($donor) {
//
//            $item = Partner::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
////            $item->image->fill($donor->image->toArray())->save();
//
//            $item->content('content')->fill($donor->content('content')->toArray())->save();
//        });
//
//        /* Careers */
//
//        $test = new Career();
//
//        $list = $test->setConnection('mirror')->get();
//
//        Career::truncate();
//
//        $list->each(function ($donor) {
//
//            $item = Career::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//            $item->content('short')->fill($donor->content('short')->toArray())->save();
//            $item->content('content')->fill($donor->content('content')->toArray())->save();
//        });
//
//        /* Graduations */
//
//        $test = new Graduation();
//
//        $list = $test->setConnection('mirror')->get();
//
//        Graduation::truncate();
//
//        $list->each(function ($donor) {
//
//            $item = Graduation::where('id',$donor->id)->firstOrNew([
//                'id'                => $donor->id,
//                'relation_id'       => $donor->relation_id,
//                'relation_type'     => $donor->relation_type,
//            ]);
//
//            $item->fill($donor->toArray())->save();
//
//            $item->content('content')->fill($donor->content('content')->toArray())->save();
//        });
//
//        Schema::enableForeignKeyConstraints();

    }

    public function pass():void
    {
        echo Str::uuid();

    }


}
