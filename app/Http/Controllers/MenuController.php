<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function list(): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.pages')->with([
                    'active' => 'menu'
                ])->render(),

                View::make('components.admin.menu.header')->with([])->render(),

                View::make('components.admin.menu.list')->with([
                    'list' => Menu::GetList(),
                ])->render(),
            ]
        ]);

    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.pages')->with([
                    'active' => 'menu_group'
                ])->render(),

                View::make('components.admin.menu.form')->with([
                    'current' => Menu::find($id),
                ])->render(),
            ]
        ]);

    }

    public function save(Request $request)
    {
        $form = $request->validate(Menu::FormRules($request->get('id')), Menu::$FormMessage);

        if (empty($request->get('id')))
            $record = new Menu();
        else
            $record = Menu::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:menu');
    }

    public function delete(int $id)
    {
        $record = Menu::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:menu');
    }

}
