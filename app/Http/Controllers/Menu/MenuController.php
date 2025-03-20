<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [
                view('admin/menu/menu'),
                view('admin/menu/menu/header'),
                view('admin/menu/menu/list',[
                    "list"  => Menu::whereNull('parent_id')->get(),
                ]),
            ]
        ]);

    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                view('admin/menu/menu'),
                view('admin/menu/menu/form',[
                    'current'   => Menu::find($id),
                    'parents'   => Menu::where('id','!=',$id)->orderBy('name')
                        ->get()->pluck('name','id'),
                ]),
            ]
        ]);

    }

    public function save(Request $request)
    {
        $form = $request->validate(Menu::FormRules($request->get('id')), Menu::FormMessage());

        if (empty($request->get('id')))
            $record = new Menu();
        else
            $record = Menu::find($request->get('id'));

        $record->fill($form);

        $record->is_tree = $request->has('is_tree');

        $record->save();

        if($request->has('ico')) {
            $ico = $record->ico ?? (new Image(['type' => 'ico', 'name' => $record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        return redirect()->route('admin:menu');
    }

    public function delete(int $id)
    {
        $record = Menu::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:menu');
    }

    public function show($code = null):string|RedirectResponse
    {

        $menu = Menu::where('show',1)->where('code',$code)->first();

        if(!$menu)
            return redirect()->route('pages:main');

        if(!$menu->items->count())
            return  redirect()->to(url('update-page'));



        return view("pages.page", [
            'contents' => [
                view('public.menu.page',[
                    'menu' => $menu,
                ]),
            ]
        ]);
    }

}
