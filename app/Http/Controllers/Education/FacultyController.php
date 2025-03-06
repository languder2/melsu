<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use App\Models\Gallery\Image;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FacultyController extends Controller
{
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.education.menu'),

                view('admin.education.faculties.header'),

                View::make('admin.education.faculties.list')->with([
                    'list' => Faculty::orderBy('order')->orderBy('name')->get(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null)
    {
        return view('admin.education.faculties.form.form',[
            'current' => Faculty::find($id),
        ]);
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

        if($form['chief'] && Staff::find($form['chief'])){
            $chief = $record->chief;

            if(!$chief)
                $chief = $record->chief()->create([
                    'type'      => 'chief',
                ]);

            $chief->staff_id    = $form['chief'];
            $chief->post        = $form['chief_post'];
            $chief->post_alt    = $form['chief_post_alt'];

            $chief->save();
        }

        if(array_key_exists('staffs',$form))
            foreach ($form['staffs'] as $affiliation_id=>$staff) {
                if(!Staff::Find($staff['staff_id'])) continue;

                $item = $record->staffs()->find($affiliation_id);

                if(!$item)
                    $item = $record->staffs()->create([
                        'type'  => 'staff',
                    ]);

                $item->fill($staff);

                $item->save();
            }

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
        elseif($form['preview']){
            $record->logo->name = $record->name;
            $record->logo->getReferenceID($form['preview']);
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
        return redirect()->route('admin:education:faculty:list');
    }

    public function delete(int $id)
    {
        $record = Faculty::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education:faculty:list');
    }
}
