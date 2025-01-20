<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.pages.header')->with([])->render(),

                View::make('components.admin.pages.list')->with([
//                    'list' => Page::GetList(),
                    'list' => [],
                ])->render(),
            ]
        ]);
    }


    public function form($id = null):string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.pages.form')->with([
                    'current' => Page::find($id),
                ])->render(),
            ]
        ]);

    }
    public function save(Request $request):string
    {
        $form = $request->validate(Page::FormRules($request->get('id')),Page::$FormMessage);

        if (empty($request->get('id')))
            $record = new Page();
        else
            $record = Page::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:pages');
    }






    public function showPage($alias) :RedirectResponse|string
    {
        $page= Page::where('alias',$alias)->first();

        if($page === null)
            return redirect()->route('pages:main');

        return view('pages.page', [
            'contents' => [
                $page->content,
            ]
        ]);
    }

}
