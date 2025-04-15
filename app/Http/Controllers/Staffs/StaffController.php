<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Menu\Menu;
use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use function Symfony\Component\VarDumper\Dumper\esc;

class StaffController extends Controller
{
    public function adminList(): string
    {

        $list= Staff::orderBy('lastname')->orderBy('firstname')->orderBy('middle_name');

        if(session()->has('AdminStaffsFilter')){
            $filter = json_decode(session()->get('AdminStaffsFilter'));

            if($filter->search)
                $list->where(DB::raw("CONCAT(lastname, ' ', firstname)"), 'like', '%'.$filter->search.'%')
                     ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', '%'.$filter->search.'%')
                     ->orWhere(DB::raw("CONCAT(lastname, ' ', firstname, ' ', middle_name)"), 'like', '%'.$filter->search.'%')
                     ->orWhere(DB::raw("CONCAT(firstname, ' ', middle_name, ' ', lastname)"), 'like', '%'.$filter->search.'%')
                     ->orWhere(DB::raw("CONCAT(middle_name, ' ', lastname, ' ', firstname)"), 'like', '%'.$filter->search.'%')
                ;
        }

        return view('pages.admin', [
            'contents' => [

                view('admin.users.menu'),

                View::make('components.admin.staff.header')->with([])->render(),

                View::make('components.admin.staff.list')->with([
                    'list' => $list->paginate(20),
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
        $staffs     = Staff::orderBy('lastname')->orderBy('firstname')->orderBy('middle_name')->paginate(30);
        $menu       = Menu::where('code','university')->first();

        return view('public.staffs.staffs.page',compact('staffs','menu'));

    }
    public function show(string $code = null)
    {

        $staff = Staff::where('alias', $code)->orWhere('id',(int)$code)->first();

        if (!$staff)
            $staff = Staff::find((int)$code);

        if (!$staff)
            return redirect()->route('pages:main');
        $menu       = Menu::where('code','university')->first();


        return view('public.staffs.staffs.single',compact('staff','menu'));
    }

    public function setFilter(Request $request):RedirectResponse
    {

        session()->put('AdminStaffsFilter',collect($request->all())->toJson(JSON_UNESCAPED_UNICODE));

        return  redirect()->back();
    }

    public function PublicSearchResult(Request $request)
    {

        session()->put('PublicStaffsSearch',collect($request->get('search'))->toJson(JSON_UNESCAPED_UNICODE));


        $staffs     = Staff::orderBy('lastname')->orderBy('firstname')->orderBy('middle_name');

        if($request->has('search')){
            $search = esc($request->get('search'));

            $staffs->where(DB::raw("CONCAT(lastname, ' ', firstname)"), 'like', '%'.$search.'%')
                ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', '%'.$search.'%')
                ->orWhere(DB::raw("CONCAT(lastname, ' ', firstname, ' ', middle_name)"), 'like', '%'.$search.'%')
                ->orWhere(DB::raw("CONCAT(firstname, ' ', middle_name, ' ', lastname)"), 'like', '%'.$search.'%')
                ->orWhere(DB::raw("CONCAT(middle_name, ' ', lastname, ' ', firstname)"), 'like', '%'.$search.'%');
        }
        $staffs = $staffs->paginate(3);


        return view('public.staffs.staffs.list',compact('staffs'));

    }

}
