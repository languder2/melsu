<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use App\Models\Education\Forms;
use App\Models\Education\Level;
use App\Models\Education\Place;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SpecialityController extends Controller
{
    public function list(): string
    {
        $list = Faculty::orderBy('order')->orderBy('name')->get();

        return view('admin.education.specialities.page', compact('list'));
    }

    public function form(Request $request, $id = null)
    {

        $current        = Speciality::find($id);
        $add2faculty    = request()->get('faculty');
        $faculties      = Faculty::pluck('name', 'code')?->toJSON(JSON_UNESCAPED_UNICODE);
        $departments    = Department::pluck('name', 'code')?->toJSON(JSON_UNESCAPED_UNICODE);
        $levels         = Level::pluck('name', 'code')?->toJSON(JSON_UNESCAPED_UNICODE);

        return view('admin.education.specialities.form',
            compact('current','add2faculty','faculties','departments','levels')
        );
    }

    public function save(Request $request)
    {

        $id = $request->speciality['id'] ?? null;

        $rules = [
            'speciality.name' => 'required',
            'speciality.code' => "required|unique:education_specialities,code,{$id},id,deleted_at,NULL",
            'speciality.spec_code' => "required",
            'speciality.faculty_code' => 'required',
            'speciality.department_code' => 'required',
            'speciality.level_code' => 'required',
            'favorite' => '',
            'speciality.description' => '',
            'order' => 'nullable|numeric',
            'profiles' => ''
        ];

        $messages = [
            'speciality.name' => 'Укажите название специальности',
            'speciality.code.required' => 'Alias специальности должен быть указан',
            'speciality.code.unique' => 'Alias специальности должен быть уникальным',
            'speciality.spec_code' => "Код специальности должен быть указан",
            'speciality.faculty_code' => 'Укажите факультет',
            'speciality.department_code' => 'Укажите кафедру',
            'speciality.level_code' => 'Укажите уровень',
        ];


        $form = $request->validate($rules, $messages);


        if ($id)
            $record = Speciality::find($id);
        else
            $record = new Speciality();


        $record->fill($form['speciality']);

        $record->save();

        foreach ($form['profiles'] as $profileForm) {
            $profile = Profile::where([
                'speciality_code' => $record->code,
                'form_code' => $profileForm['form_code'],
            ])->first();

            if (!$profile)
                $profile = new Profile([
                    'speciality_code' => $record->code,
                    'form_code' => $profileForm['form_code'],
                    'alias' => "{$record->code}-{$profileForm['form_code']}",
                ]);

            $profileForm['show'] = isset($profileForm['show']);

            $profileForm['afc'] = isset($profileForm['afc']);

            $profile->fill($profileForm);

            $profile->save();

            foreach ($profileForm['places'] as $type => $count) {
                $place = $profile->places->where('type', $type)->first();

                if (!$place)
                    $place = $profile->places()->create(['type' => $type]);

                $place->count = $count;
                $place->save();
            }

            foreach ($profileForm['exams'] as $type => $list) {
                foreach ($list as $subject_id => $item) {
                    $exam = $profile->exams()->where([
                        'type' => $type,
                        'subject_id' => $subject_id,
                    ])->first();

                    if (!$exam)
                        $exam = $profile->exams()->create([
                            'type' => $type,
                            'subject_id' => $subject_id,
                        ]);

                    if (!isset($item['required']))
                        $item['required'] = false;

                    if (!isset($item['selectable']) || $item['required'])
                        $item['selectable'] = false;

                    $exam->fill($item);
                    $exam->save();

                }
            }
        }

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
