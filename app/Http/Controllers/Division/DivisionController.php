<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use App\Models\News\RelationNews;
use App\Models\Page\Content as PageContent;
use App\Models\Partner\Partner;
use App\Models\Sections\Contact;
use App\Models\Staff\Affiliation;
use App\Models\Upbringing\Upbringing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function adminList($code = 'without-group'): string
    {
        $list = Division::whereNull('parent_id')->orderBy('name')->get();

        return view('divisions.admin.list', compact('list'));
    }

    public function form(Request $request,$id = null): View|RedirectResponse
    {
        $current = Division::find($id);

        if(!$current)
            $current = new Division();

        $parents = Division::where('id','!=',$id)->orderBy('name')->get()->pluck('name','id');

        $types = DivisionType::forSelect();

        return view('divisions.admin.form.page',compact('parents','current','types'));
    }

    public function save(Request $request)
    {
        $form = $request->validate(Division::FormRules($request->get('id')), Division::FormMessage());

        if (empty($request->get('id')))
            $record = new Division();
        else
            $record = Division::find($request->get('id'));

        $record->fill($form);

        if($request->has('coordinator'))
            $record->coordinator_id = $request->get('coordinator')['staff_id'] ?? null;

        $record->show = array_key_exists('show', $form);

        $record->save();

        if(in_array($record->type,[DivisionType::Faculty,DivisionType::Department]))
            foreach ($record->specialities as $speciality)
                Speciality::updateAffiliation($speciality,$record);



//        $record->partnerSections()->updateOrCreate();
//        /* chief */
//        if(array_key_exists('chief',$form))
//            Affiliation::ProcessingChief($record,$form['chief']);
//
//        /* staffs */
//        if(array_key_exists('staffs',$form))
//            foreach ($form['staffs'] as $aID=>$staff)
//                Affiliation::ProcessingStaff($record,$aID,$staff);


        if($request->has('ico')){
            $ico = $record->ico ?? ( new Image(['type'=>'ico','name'=>$record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        /* upload image */
        if($request->file('image'))
            $record->preview->relation()->associate($record)->saveImage($request->file('image'));

        /* image form gallery */
        elseif($request->has('preview') && $record->preview->src != $request->get('preview')){
            $record->preview->fill([
                'name'          => $record->name,
                'reference_id'  => $record->preview::getReference($request->get('preview')),
                'filename'      => null,
                'filetype'      => null,
            ])
                ->relation()->associate($record)
                ->save();

        }

        /* add content sections*/
        if(array_key_exists('sections',$form))
            PageContent::processing($record,$request->get('sections'));

        /* add contacts*/
        if($request->has('contacts'))
            Contact::processing($record,$request->get('contacts'));

        /* add news*/
        if($request->has('news')){
            RelationNews::processingForms($record,request()->all('news')['news']);
        }

        /* add content upbringing sections*/
        if ($request->has('upbringing_sections')) {
            foreach ($request->input('upbringing_sections') as $id => $data) {
                $data['relation_id'] = $record->id;
                $data['relation_type'] = get_class($record);

                $data['show_title'] = !empty($data['show_title']) ? 1 : 0;
                $data['show'] = !empty($data['show']) ? 1 : 0;

                Upbringing::updateOrCreate(['id' => $id], $data);
            }
        }

        /* add content partner sections*/
        if ($request->has('partner_sections')) {
            foreach ($request->input('partner_sections') as $id => $data) {
                $data['relation_id'] = $record->id;
                $data['relation_type'] = get_class($record);

                $data['show_title'] = !empty($data['show_title']) ? 1 : 0;
                $data['show'] = !empty($data['show']) ? 1 : 0;

                Partner::updateOrCreate(['id' => $id], $data);
            }
        }

        switch ($record->type) {
            case DivisionType::Institute:
                return redirect()->route('admin:institutes:list');
            case DivisionType::Faculty:
                return redirect()->route('admin:faculty:list');
            case DivisionType::Department:
                return redirect()->route('admin:department:list');
            case DivisionType::Lab:
                return redirect()->route('admin:lab:list');
            default:
                return redirect()->route('admin:division:list');
        }
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
        $division   = Division::where('code', 'rectorate')->first();
        $menu       = Menu::where('code','university')->first();
        $depth      = 0;

        return view('divisions.public.list.page',compact('division','depth','menu'));
    }

    public function show($code = null):View|RedirectResponse
    {
        $division   = Division::where('code', $code)->orWhere('id',(int)$code)->first();

        if (!$division || !$division->show)
            return redirect()->route('public:division:list');

        $menu = Menu::where('code','university')->first();

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
