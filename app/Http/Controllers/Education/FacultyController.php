<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Division\Division;
use App\Models\Education\Faculty;
use App\Models\Menu\Menu;
use App\Models\Staff\Affiliation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacultyController extends Controller
{
    public function list():View
    {
        $list = Faculty::orderBy('order')->orderBy('name')->get();

        return view('admin.education.faculties.page', compact('list'));
    }

    public function form($id = null):View
    {
        $current = Faculty::find($id);

        if(!$current)
            $current= new Faculty();

        $current->contacts()->create(['type'=>'phone','content'=>'extend test']);

        return view('admin.education.faculties.form.page', compact('current'));
    }

    public function save(Request $request):RedirectResponse
    {
        $form = $request->validate(Faculty::FormRules($request->get('id')), Faculty::FormMessage());

        if (empty($request->get('id')))
            $record = new Faculty();
        else
            $record = Faculty::find($request->get('id'));

        $record->fill($form);

        $record->show = array_key_exists('show',$form);

        $record->save();

        if(array_key_exists('chief',$form))
            Affiliation::ProcessingChief($record,$form['chief']);

        if(array_key_exists('staffs',$form))
            foreach ($form['staffs'] as $aID=>$staff)
                Affiliation::ProcessingStaff($record,$aID,$staff);

        if(!$record->logo)
            $record->logo = $record->logo()->create([
                'name'          => $record->name,
                'type'          => 'logo',
            ])->save();

        if($request->file('image')){
            $record->logo->saveImage($request->file('image'));
            $record->logo->reference_id = null;
            $record->logo->save();
        }
        elseif($request->has('preview')){
            $record->logo->name = $record->name;
            $record->logo->getReferenceID($request->get('preview'));
            $record->logo->save();
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

        if($request->has('contacts'))
            Contact::processing($record,$request->get('contacts'));

        return redirect()->route('admin:faculty:list');
    }

    public function delete(int $id):RedirectResponse
    {
        $record = Faculty::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:faculty:list');
    }


    public function faculties(): View
    {
        $list = Division::where('show',1)
            ->where('type',DivisionType::Faculty)
            ->orderBy('sort')
            ->orderBy('name')
            ->get()
        ;

        return view('public.education.faculties.list', compact('list'));
    }

    public function faculty(?Division $division = null,?string $section = null )
    {
        if(!$division)
            return redirect()->to(route('public:education:faculties'));

        return view('public.education.faculty.page',compact('division','section'));
    }

    public function departments(?Division $division): View|RedirectResponse
    {
        if ($division === null)
            return redirect()->to(route('public:education:faculties'));

        if($division->departments->isEmpty() && $division->labs->isEmpty() && $division->faculty_labs->isEmpty())
            return redirect()->to($division->link);

        return view('public.education.departments.related',compact('division'));
    }

    public function staffs(?Division $division, ?string $code= null, ?string $type= null)
    {

        dd($division);

        if (!$division)
            return redirect()->to(route('public:education:faculties'));


        dd($division);
        return view('public.education.faculty.page',compact('division','type'));
    }



}
