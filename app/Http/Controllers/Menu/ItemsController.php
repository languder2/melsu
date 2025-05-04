<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Menu\Item as MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ItemsController extends Controller
{
    public function list(): \Illuminate\View\View
    {
        $list = Menu::orderBy('name')->get();

        return view('menu.admin.items.list', compact('list'));
    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                view('admin/menu/menu'),

                View::make('admin/menu/items/form')->with([
                    'menu' => Menu::orderBy('name')->get()->pluck('name', 'id'),
                    'pages' => Page::orderBy('name')->get()->pluck('name', 'id'),
                    'parents' => MenuItem::whereNull('parent_id')->where('id','!=',$id)
                        ->orderBy('name')->get()->pluck('name', 'id'),
                    'current' => MenuItem::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(MenuItem::FormRules($request->get('id')), MenuItem::FormMessage());

        if (empty($request->get('id')))
            $record = new MenuItem();
        else
            $record = MenuItem::find($request->get('id'));

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        if (!is_null($form['page_id']))
            $record->link = Page::GelLinkByID($form['page_id']);
        elseif ($form['route'] && Route::has($form['route']))
            $record->link = url(route($form['route']));

        $record->save();

        if($request->file('image')){
            $record->preview->saveImage($request->file('image'));
            $record->preview->reference_id = null;
            $record->preview->save();
        }
        elseif($form['preview']){
            $record->preview->name = $record->name;
            $record->preview->getReferenceID($form['preview']);
            $record->preview->save();
        }

        return redirect()->route('admin:menu-items');
    }

    public function delete(int $id)
    {
        $record = MenuItem::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:menu-items');
    }


}
