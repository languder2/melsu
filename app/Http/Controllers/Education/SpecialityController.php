<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\Level;
use App\Models\Education\Forms;
use App\Models\Education\Faculty;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SpecialityController extends Controller
{
    public function list():string
    {

        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.education')->with([
                    'active'    => 'specialities'
                ])->render(),

                View::make('components.admin.education.specialities.header')->with([])->render(),

                View::make('components.admin.education.specialities.list')->with([
                    'list' => Faculty::orderBy('order','desc')->orderBy('name')->get(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null,)
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.education')->with([
                    'active'    => 'specialities'
                ])->render(),

                View::make('components.admin.education.specialities.form.form')->with([
                    'current'       => Speciality::find($id)?->toJSON(JSON_UNESCAPED_UNICODE),
                    'add2faculty'   => request()->get('faculty'),
                    'faculties'     => Faculty::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                    'departments'   => Department::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                    'levels'        => Level::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $id = $request->get('id');

        $id = 119;

        $rules = [
            'speciality.name'               => 'required',
            'speciality.code'               => "required|unique:education_specialities,code,{$id},id,deleted_at,NULL",
            'speciality.spec_code'          => "required",
            'speciality.faculty_code'       => 'required',
            'speciality.department_code'    => 'required',
            'speciality.level_code'         => 'required',
            'favorite'                      => '',
            'speciality.description'        => '',
            'order'                         => 'nullable|numeric',
            'profiles'                      => ''
        ];

        $messages = [
            'speciality.name'               => 'Укажите название специальности',
            'speciality.code.required'      => 'Alias специальности должен быть указан',
            'speciality.code.unique'        => 'Alias специальности должен быть уникальным',
            'speciality.spec_code'          => "Код специальности должен быть указан",
            'speciality.faculty_code'       => 'Укажите факультет',
            'speciality.department_code'    => 'Укажите кафедру',
            'speciality.level_code'         => 'Укажите уровень',
        ];


        $form = $request->validate($rules,$messages);


        if ($id)
            $record = Speciality::find($id);
        else
            $record = new Speciality();


        $record->fill($form['speciality']);

        $record->save();

        foreach ($form['profiles'] as $profileForm) {
            $profile = Profile::where([
                'speciality_code'   => $record->code,
                'form_code'         => $profileForm['form_code'],
            ])->first();

            if(!$profile)
                $profile = new Profile([
                    'speciality_code'   => $record->code,
                    'form_code'         => $profileForm['form_code'],
                    'alias'             => "{$record->code}-{$profileForm['form_code']}",
                ]);

            if(isset($profileForm['show']))
                $profileForm['show'] = (boolean)$profileForm['show'];

            if(isset($profileForm['afc']))
                $profileForm['afc']  = (boolean)$profileForm['afc'];

            $profile->fill($profileForm);

            $profile->save();
        }
dd(1);
//        $record->profiles();


//        $record->save();


        dd($record);

        return redirect()->route('admin:education-speciality:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-speciality:list');
    }
}
