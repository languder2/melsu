<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\{News, NewsCategory};
use App\Models\ImageStorage;

class NewsController extends Controller
{
    public function adminList():string
    {
        return view('pages.admin',[
            'contents'  => [
                View::make('components.admin.news.news')->with([
                    'list'      => News::orderBy('publication_at','desc')->get(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null):string
    {
        return view('pages.admin',[
            'contents'  => [
                View::make('components.admin.news.form')->with([
                    'categories'        => NewsCategory::getListForSelect(),
                    'current'           => News::find($id),

                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $form = $request->validate(News::$FormRules,News::$FormMessage);

        if(empty($request->get('id')))
            $record = new News();
        else
            $record = News::find($request->get('id'));

        $record->fill($form);

        $record->save();

        $image = (object)$request->validate(ImageStorage::$FormRules,ImageStorage::$FormMessage);

        if(!isset($image->image))
            return redirect()->route('admin:news');


        $record->image= 'news-'.$record->id;

        $record->save();

        $image->image->storePubliclyAS('images/news', 'original.'.$image->image->extension(), 'public');

        ImageStorage::saveResizedImageToStorage('news',$image->image->path(),'news-'.$record->id,[
            "600:600",'900:900',[1200,1200]
        ]);

        return redirect()->route('admin:news');
    }


}
