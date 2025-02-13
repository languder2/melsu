<?php

namespace App\Http\Controllers;

use App\Models\ImageStorage;
use App\Models\Menu;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Collection;
class StaffController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.staff.header')->with([])->render(),

                View::make('components.admin.staff.list')->with([
                    'list' => Staff::orderBy('id', 'desc')->paginate(1000),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.staff.form')->with([
                    'current' => Staff::getByID($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(Staff::FormRules($request->get('id')), Staff::$FormMessage);

        if (empty($request->get('id')))
            $record = new Staff();
        else
            $record = Staff::find($request->get('id'));

        if (is_array($form['works']))
            $form['works'] =
                array_values(array_filter($form['works'], function ($work) {
                    return !empty($work['post']);
                }));

        if (count($form['works']))
            $form['works'] = json_encode(
                $form['works'],
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT
            );

        else
            $form['works'] = null;

        $record->fill($form);

        $record->save();

        $photo = (object)$request->validate(
            ImageStorage::getValidateRules('photo'),
            ImageStorage::getValidateRules('photo')
        );


        if (!isset($photo->photo))
            return redirect()->route('admin:staff');

        else
            $photo = $photo->photo;


        $record->photo = 'photo-' . $record->id;

        $record->save();

        $photo->storeAS('images/photo', 'original.' . $photo->extension(), 'public');

        ImageStorage::saveResizedImageToStorage('photo', $photo->path(), 'photo-' . $record->id, [
            [600, 600],
        ]);

        return redirect()->route('admin:staff');
    }

    public function worksAddLine($i = 0)
    {
        return View::make('components.admin.staff.work')->with([
            'i' => $i,
        ])->render();
    }

    public function delete(int $id)
    {
        $record = Staff::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:staff');
    }

    public function list(Request $request):string|RedirectResponse
    {
        return view("pages.page-with-menu", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'nobg' => true,

            'news' => false,

            'menu' => Menu::getMenuFromMain(route('public:staff:list')),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'staffs',
                'element'   => null,
            ],

            'contents' => [
//                View::make('components.staff.single')->with([
//                    'staff' => $staff,
//                ])->render(),

                "staffs"
            ]

        ]);
    }
    public function show(Request $request, $code):string|RedirectResponse
    {

        $staff = Staff::where('alias', $code)->first();

        if (!$staff)
            $staff = Staff::find((int)$code);

        if (!$staff)
            return redirect()->route('pages:main');

        return view("pages.page-with-menu", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'nobg' => true,

            'news' => false,

            'menu' => Menu::getMenuFromMain(($code==='rector')?$request->path():route('public:staff:list')),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'staff',
                'element'   => $staff,
            ],

            'contents' => [
                View::make('components.staff.single')->with([
                    'staff' => $staff,
                ])->render(),
            ]

        ]);
    }

}
