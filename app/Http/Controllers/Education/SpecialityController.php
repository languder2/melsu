<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Department;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use App\Models\Page\Content as PageContent;
use App\Models\Sections\Career;
use App\Models\Sections\FAQ;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function list(): string
    {
        $list   = Division::where('type',DivisionType::Faculty)->orderBy('name')->get();
        $spo    = Speciality::whereNull('faculty_id')->orderBy('name')->get();

        return view('admin.education.specialities.list', compact('list','spo'));
    }

    public function form($id = null)
    {

        $current        = Speciality::find($id) ?? new Speciality();

        $faculties      = Division::where('type',DivisionType::Faculty)
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');

        $departments    = Division::where('type',DivisionType::Department)
                            ->orderBy('alt_name')
                            ->get()
                            ->pluck('alt_name', 'id');

        $branches       = Division::where('type',DivisionType::Branch)
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');

        return view('admin.education.specialities.form',
            compact('current','faculties','departments','branches')
        );
    }

    public function save(Request $request)
    {

        $form = $request->validate(Speciality::FormRules($request->get('id')),Speciality::FormMessage());

        $record = Speciality::find($request->get('id'));

        if(!$record)
            $record = new Speciality();

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        $record->save();

        if($request->has('branch_id')){
            $branch = Division::find($request->get('branch_id'));

            if($branch)
                $record->relation()->associate($branch)->save();
        }

        if($request->has('ico')){
            $ico = $record->ico ?? ( new Image(['type'=>'ico','name'=>$record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        if($request->has('sections'))
            PageContent::processing($record,$request->get('sections'));

        if($request->has('profiles'))
            Profile::processing($record,$request->get('profiles'));


        if($request->has('faq'))
            FAQ::processing($record,$request->get('faq'));

        if($request->has('career'))
            Career::processing($record,$request->get('career'));

        return redirect()->route('admin:speciality:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:speciality:list');
    }

    public function showAll()
    {
        $menu= Menu::where('code','education')->first();

        return view('public.education.speciality.all',compact('menu'));
    }

    public function showSingle(Speciality $speciality)
    {
        if (!$speciality)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::where('code','education')->first();

        return view('public.education.speciality.single',compact('speciality','menu'));
    }

}
