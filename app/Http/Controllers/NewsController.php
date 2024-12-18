<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\suStructure;
use App\View\Components\admin\structure\form as structureForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
class NewsController extends Controller
{
    public function adminList():string
    {
        return view('pages.admin',[
            'contents'  => [
                View::make('components.admin.news.news')->with([

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

        $form = (object)$request->validate(News::$FormRules,News::$FormMessage);

        dump($form->image->path());
//        dump($form->image->dimensions());
//        dump($form->image->extension());


        $path = $form->image->storePubliclyAS('images/news', 'test.'.$form->image->extension(), 'public');
        //$image = Image::make(public_path($path))->fit(300, 200)->save('resized.jpg', 60);

        $image = ImageManager::imagick()->read($form->image->path());

        $image->resize(300, 200);

        $image->save('public_html/images/news/bar.jpg', 60);

        dd($image);
        $image = new ImageManager( Driver::class,
            autoOrientation: false,
            decodeAnimation: true,
            blendingColor: 'ff5500');

        dd($image);
        dump($path);


        return view('pages.admin',[
            'contents'  => [
                View::make('components.admin.news.img-base')->with([
                    "path"      => $path
                ])->render(),
            ]
        ]);


        dd($form);


        if(empty($form['sort'])){
            $last           = suStructure::where('ssu_group',$form['ssu_group'])->orderBy('sort','desc')->first();

            if(is_null($last))
                $form['sort'] = 10;

            else
                $form['sort']   = $last->sort+10;
        }

        if(empty($request->get('id')))
            $record = new suStructure($form);
        else{
            $record = suStructure::find($request->get('id'));
            $record->fill($form);
        }

        $record->save();

        return redirect()->route('admin:structure');
    }


}
