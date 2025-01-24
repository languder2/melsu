<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\{Menu,MenuItems};

class PagesController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.pages')->with([
                    'active'    => 'pages'
                ])->render(),

                View::make('components.admin.pages.header')->with([])->render(),

                View::make('components.admin.pages.list')->with([
                    'list' => Page::GetList(),
                ])->render(),
            ]
        ]);
    }


    public function form($id = null):string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.pages.form')->with([
                    'pages'         => Page::orderBy('name')->get(),
                    'sidebars'      => Menu::orderBy('name')->get(),
                    'current'       => Page::find($id),
                ])->render(),
            ]
        ]);

    }
    public function save(Request $request):string|RedirectResponse
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

    public function delete(int $id)
    {
        $record = Page::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:pages');
    }

    public function showPage($alias) :RedirectResponse|string
    {
        $page= Page::where('alias',$alias)->first();

        if($page === null)
            return redirect()->route('pages:main');

        if(!is_null($page->view) && View::exists("pages.content.{$page->view}"))
            $content    = view("pages.content.{$page->view}")->render();
        else
            $content    = $page->content;

        if(!is_null($page->menu_id))
            $menu       = MenuItems::getSideMenuForPage($page->menu_id,$page->id);

        $layout = 'pages.page';

        if(isset($menu))
            $layout = 'pages.page-with-menu';

        if(empty($content))
            return redirect()->route('pages:main');

        $breadcrumbs = Page::getBreadCrumbs($page->id);

        return view($layout, [
            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
                                'current'   => array_slice($breadcrumbs, -1)[0],
                                'last'      => array_slice($breadcrumbs, -2, 1)[0],
                                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
                            ])->render(),
            'sidebar'       => View::make('components.menu.sidebar')->with([
                                'menu'          => &$menu,
                                'full'          => false,
                            ])->render(),

            'nobg'          => in_array($page->alias,[
                'sved',
                'why-melsu',
                'science',
            ]),

            'contents'      => [
                &$content,
            ]

        ]);
    }

}
