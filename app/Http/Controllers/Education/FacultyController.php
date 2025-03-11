<?php

namespace App\Http\Controllers\Education;

use App\Enums\ContactType;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Education\Faculty;
use App\Models\Gallery\Image;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

class FacultyController extends Controller
{
    public function list()
    {
        $list = Faculty::orderBy('order')->orderBy('name')->get();

        return view('admin.education.faculties.page', compact('list'));
    }

    public function form($id = null)
    {

        $current = Faculty::find($id);

        if(!$current)
            $current= new Faculty();


        $current->contacts()->create(['type'=>'phone','content'=>'extend test']);

        return view('admin.education.faculties.form.page', compact('current'));
    }

    public function save(Request $request)
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

    public function delete(int $id)
    {
        $record = Faculty::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:faculty:list');
    }
}
