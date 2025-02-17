<?php

namespace App\Http\Controllers;

use App\Models\Gallery\Gallery;
use App\Models\ImageStorage;
use App\Models\Menu;
use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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
                    'list' => Staff::orderBy('lastname')->orderBy('firstname')->orderBy('middle_name')->paginate(20),
                ])->render(),
            ]
        ]);
    }

    public function form(?int $id = null): string
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.staff.form')->with([
                    'current' => Staff::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(Staff::FormRules($request->get('id')), Staff::FormMessage());

        if (empty($request->get('id')))
            $record = new Staff();
        else
            $record = Staff::find($request->get('id'));

        $record->fill($form);

        $record->save();

        if($form['posts'])
            foreach($form['posts'] as $postData){
                if(!$postData['post']) continue;

                $post = $record->posts()->find($postData['id']);

                if(!$post)
                    $post = $record->posts()->create($postData);

                $post->show =  array_key_exists('show', $postData);;

                $post->save();
            }

        if($request->file('photo')){

            if(!$record->avatar)
                $record->avatar = $record->avatar()->create([
                    'name'          => $record->full_name,
                    'type'          => 'avatar',
                ]);
            else
                $record->avatar->name = $record->full_name;

            $record->avatar->saveImage($request->file('photo'));

            $record->avatar->save();
        }

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

    public function ApiDelete (Request $request,?int $id = null): JsonResponse
    {

        if(!$id)
            return response()->json(
                [
                    'message' => "Должность удалена"
                ]);

        $post = Post::Find($id);

        if(!$post)
            return response()->json([],204);

        $post->delete();

        return response()->json(
            [
                'message' => "Должность удалена\n{$post->post}\n Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
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
