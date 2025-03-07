<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Faculty;
use App\Models\Education\Department as EducationDepartment;
use App\Models\Education\Lab;
use App\Models\Menu\Menu;
use App\Models\Staff\Affiliation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function adminList($code = 'without-group'): string
    {
        $list = Division::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.divisions.list', compact('list'));
    }

    public function form(Request $request,$id = null): View|RedirectResponse
    {
        $parents = Division::query();

        if($id)
            if($current = Division::find($id))
                $parents->where('id','!=',$id);
            else
                return redirect()->route('admin:division:list');
        else
            $current = null;

        $parents = $parents->orderBy('name')->get()->pluck('name','id');

        return view('admin.divisions.form.page',compact('parents','current'));
    }

    public function save(Request $request)
    {
        $form = $request->validate(Division::FormRules($request->get('id')), Division::FormMessage());

        if (empty($request->get('id')))
            $record = new Division();
        else
            $record = Division::find($request->get('id'));

        if($request->has('coordinator'))
            $record->coordinator_id = $request->get('coordinator')['staff_id'] ?? null;

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        if(request()->get('identity')){
            $identity = explode(':',$request->get('identity'));

            switch ($identity[0]) {
                case 'faculty':
                    $identity = Faculty::find($identity[1]);
                break;

                case 'department':
                    $identity = EducationDepartment::find($identity[1]);
                break;

                case 'lab':
                    $identity = Lab::find($identity[1]);
                break;

                default:
                    $identity = null;
                break;
            }

            if($identity)
                $record->relation()->associate($identity)->save();
        }

        $record->show = array_key_exists('show',$form);

        $record->save();


        if(array_key_exists('chief',$form))
            Affiliation::ProcessingChief($record,$form['chief']);


        if(array_key_exists('staffs',$form))
            foreach ($form['staffs'] as $aID=>$staff)
                Affiliation::ProcessingStaff($record,$aID,$staff);

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

        if(array_key_exists('sections',$form)){
            foreach ($form['sections'] as $section_id=>$section) {
                if(!$section['title']) continue;

                $item = $record->sections()->find($section_id);

                if(!$item)
                    $item = $record->sections()->create(['title'=> 'new']);

                $item->fill($section);

                $item->show         = array_key_exists('show',$section);
                $item->show_title   = array_key_exists('show_title',$section);

                $item->save();
            }
        }

        return redirect()->route('admin:division:list');
    }

    public function delete(int $id)
    {
        $record = Division::find($id);

        if (!is_null($record))
            $record->delete();

        $list = Division::where('parent_id',$id)->get();

        foreach ($list as $item)
            $item->fill(['parent_id' => null])->save();

        return redirect()->route('admin:division:list');
    }

    /* Public */
    public function publicList(Request $request):View
    {

        return view('public.divisions.list.page',[
            'division'      => Division::where('code', 'rectorate')->first(),
            'menu'          => Menu::where('code','university')->first(),
            'depth'         => 0
        ]);
    }

    public function show($code = null):View|RedirectResponse
    {

        $division   = Division::where('code', $code)->orWhere('id',(int)$code)->first();

        if (!$division || !$division->show)
            return redirect()->route('public:division:list');

        $menu       = Menu::where('code','university')->first();


        if (strtolower($division->code) === 'rectorate')
            return view('public.divisions.rectorate.page', compact('menu','division'));
        else
            return view('public.divisions.single.page', compact('menu','division'));
    }


    /* API */
    public function ApiVacatePosition(Request $request,$affiliation_id = null): JsonResponse
    {

        $item = Affiliation::find($affiliation_id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Вакансия освобождена"
            ]);
    }

    /* Public search */

    public function PublicSearchResult(Request $request)
    {
        $division = Division::where('code', 'rectorate')->first();

        if($request->has('search'))
            Division::search($division,$request->get('search'));
        else
            Division::search($division,'Отдел по работе с обучающимися');

        $depth = 0;

        return view('public.divisions.list.list',compact('division','depth'));

    }



}
