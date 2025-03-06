<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Menu\Menu;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Page\Content;

class PagesController extends Controller
{
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.pages')->with([
                    'active' => 'pages'
                ])->render(),

                View::make('components.admin.pages.header')->with([])->render(),

                View::make('components.admin.pages.list')->with([
                    'list' => Page::GetList(),
                ])->render(),
            ]
        ]);
    }


    public function form($id = null): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.pages.form')->with([
                    'pages' => Page::orderBy('name')->get(),
                    'sidebars' => Menu::orderBy('name')->get(),
                    'current' => Page::find($id),
                ])->render(),
            ]
        ]);

    }

    public function save(Request $request): string|RedirectResponse
    {
        $form = $request->validate(Page::FormRules($request->get('id')), Page::FormMessage());

        if (empty($request->get('id')))
            $record = new Page();
        else
            $record = Page::find($request->get('id'));

        $record->fill($form);

        $record->without_bg = array_key_exists('without_bg', $form);

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

    public function ApiDeleteSection($id = null): JsonResponse
    {
        $item = Content::find($id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Секция контента удалена"
            ]);
    }


    public function showPage(Request $request, $alias): RedirectResponse|string
    {
        $page = Page::where('alias', $alias)->first();


        if (!$page)
            return redirect()->route('pages:main');

        if (!is_null($page->view) && View::exists("pages.content.{$page->view}"))
            $content = view("pages.content.{$page->view}")->render();
        else
            $content = $page->content;


        $menu = Menu::where('show',1)->find($page->menu_id);

        if($menu)
            $aside = view(
                $menu->is_tree?'public.menu.aside-tree':'public.menu.aside',
                ['menu' => $menu]
            );

        if (empty($content))
            return redirect()->route('pages:main');


        return view($menu?'pages.page-with-menu':'pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'pages',
                'element'   => $page,
            ],


            'sidebar' => @$aside,

            'includes'    =>[
                'jquery',
            ],

            'nobg' => !empty($page->without_bg),

            'news' => false,

            'contents' => [
                &$content,
            ]

        ]);
    }

}
