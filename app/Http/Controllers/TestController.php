<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\DocumentTypes;
use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\Entities;
use App\Enums\Info\Base;
use App\Enums\Info\Common;
use App\Enums\Info\Types;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Education\Duration;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Employees\Employee;
use App\Models\Global\Options;
use App\Models\Info\Info;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoFounder;
use App\Models\Info\InfoStandarts;
use App\Models\News\Events;
use App\Models\News\News;
use App\Models\News\RelationNews;
use App\Models\Page\Content;
use App\Models\Page\Page;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use App\Models\Users\User;
use App\Models\Users\UserAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PhpOption\Option;
use function PHPUnit\Framework\matches;

class TestController extends Controller
{
    public function token()
    {
        dump(session()->token());
    }

    public function phpinfo():void
    {
        phpinfo();
    }

    public function view()
    {
        $list = collect([]);

        return view('test.view',compact('list'));
    }

    public function admin()
    {
//        $i = 0;
//
//        while(News::skip($i*10)->take(10)->get()->count()){
//            $i++;
//            News::skip($i*10)->take(10)->get()->each(function ($news) use ($i) {
//
//                if($news->getRawOriginal('short'))
//                    $news->getShortRecord()->fill(['content'=> $news->getRawOriginal('short')])->save();
//
//                if($news->getRawOriginal('full'))
//                    $news->getFullRecord()->fill(['content'=> $news->getRawOriginal('full')])->save();
//
//                if($news->getRawOriginal('news'))
//                    $news->getContentRecord()->fill(['content'=> $news->getRawOriginal('news')])->save();
//            });
//        }

//        RelationNews::all()->each(function ($rn) {
//            $news = new News();
//
//            $news->fill($rn->toArray());
//
//            if($rn->author)
//                $news->author()->associate($rn->author);
//
//            $news->save();
//
//            if($rn->getShortRecord()->exists)
//                $rn->getShortRecord()->relation()->associate($news)->save();
//
//            if($rn->getContentRecord()->exists)
//                $rn->getContentRecord()->relation()->associate($news)->save();
//
//            $rn->delete();
//        });


        $news = News::find(793);

        dd($news->preview->src);

        dd('completed');

    }

    public function index(): View
    {

        dd(DivisionType::labels());

        $list = collect();

//        Division::all()->each(function ($division){
//            $user = User::where('name', "d{$division->id}")->get()->first();
//
//            if(!$user){
//                $password = Str::random(3)."-".Str::random(3)."-".Str::random(3)."-".Str::random(3);
//                $user = new User(['name'=>"d{$division->id}",'email'=> "d{$division->id}@melsu.ru", 'password'=> bcrypt($password)]);
//                $user->save();
//            }
//
//            $division->getAccess($user);
//        });


        $time = microtime(true);

        $list = User::where('email','like','d%@melsu.ru')->get()
        ->each(function ($item){
//            $password = Str::random(3)."-".Str::random(3)."-".Str::random(3)."-".Str::random(3);
//            $item->password = bcrypt($password);
//            $item->save();
//            $item->pass = $password;
//            $item->divisions = $item->access->map->relation->pluck('name');
            return $item;
        });

        return view('test.index',compact('list'));
    }


    public function staffs(): View
    {

        Employee::truncate();

        Division::where('type',DivisionType::Department)->get()->each(function ($item){
            $item->staffs->each(function ($staff){

                $staff->fill(['is_teacher' => 1])->save();

                if(!$staff->card->employee)
                    (new Employee([
                        "staff_id" => $staff->card->id,
                    ]))->save();
            });
        });


//        $list   = Staff::all()->groupBy('full_name')->where(fn($item) => $item->count()>1);
//
//        $list2  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->groupBy('full_name');
//
//        foreach ($list2 as $code=>$item)
//            if(!$list->has($code))
//                $list->put($code,$item);

        $list  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->each(fn($item) => $item->delete());
        $list  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->groupBy('full_name');

        return view('test.staffs',compact('list'));
    }


}
