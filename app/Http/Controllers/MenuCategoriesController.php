<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\MenuCategories;

class MenuCategoriesController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.menu_categories.header')->with([])->render(),

                View::make('components.admin.menu_categories.list')->with([
                    'list' => MenuCategories::GetList(),
                ])->render(),
            ]
        ]);

    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.menu_categories.form')->with([
                    'current' => MenuCategories::find($id),
                ])->render(),
            ]
        ]);

    }

    public function save(Request $request)
    {
        $form = $request->validate(MenuCategories::FormRules($request->get('id')),MenuCategories::$FormMessage);

        if (empty($request->get('id')))
            $record = new MenuCategories();
        else
            $record = MenuCategories::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:menu-categories');
    }

    public function delete(int $id)
    {
        $record = MenuCategories::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:menu-categories');
    }

}
