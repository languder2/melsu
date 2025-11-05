<?php

namespace App\Http\Controllers;

use App\Models\Page\Page;
use Illuminate\View\View;

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

        return view('test.view',compact('list'));
    }

    public function index()
    {
        $list = collect();

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

        return view('test.index',compact('list'));
    }


}
