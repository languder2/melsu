<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Page;

class MenuItemsController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.pages')->with([
                    'active'    => 'menu-items'
                ])->render(),

                View::make('components.admin.menu_items.header')->with([])->render(),

                View::make('components.admin.menu_items.list')->with([
                    'list' => MenuItems::GetListByMenu(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.pages')->with([
                    'active'    => 'menu-items'
                ])->render(),

                View::make('components.admin.menu_items.form')->with([
                    'menu'          => Menu::orderBy('name')->get(),
                    'pages'         => Page::orderBy('name')->get(),
                    'parents'       => MenuItems::GelListForForm(),
                    'current'       => MenuItems::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(MenuItems::FormRules($request->get('id')),MenuItems::$FormMessage);

        if (empty($request->get('id')))
            $record = new MenuItems();
        else
            $record = MenuItems::find($request->get('id'));

        $record->fill($form);

        if(!is_null($form['page_id']))
            $record->link   = Page::GelLinkByID($form['page_id']);

        $record->save();

        return redirect()->route('admin:menu-items');
    }

    public function delete(int $id)
    {
        $record = MenuItems::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:menu-items');
    }


}
