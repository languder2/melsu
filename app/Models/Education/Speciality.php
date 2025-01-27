<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speciality extends Model
{
    use SoftDeletes;

    protected $table = 'education_specialities';

    protected $fillable = [
        'id',
        'name',
        'code',
        'spec_code',
        'faculty_code',
        'department_code',
        'level_code',
        'places',
        'description',
        'sort',
        'created_at',
        'deleted_at',
    ];

    public static function FormRules($id):array
    {
        return [
            'name'              => 'required',
            'code'              => "required|unique:education_specialities,code,{$id},id,deleted_at,NULL",
            'spec_code'         => "required",
            'faculty_code'      => 'required',
            'department_code'   => 'required',
            'level_code'        => 'required',
            'places'            => '',
            'description'       => '',
            'sort'              => 'nullable|numeric',
        ];
    }

    public static function FormMessage():array
    {
        return [
            'name'                      => 'Укажите заголовок',
            'code.required'             => 'Код должен быть указан',
            'code.unique'               => 'Код должен быть уникальным',
            'spec_code'                 => "Код специальности должен быть указан",
            'faculty_code'              => 'Укажите факультет',
            'department_code'           => 'Укажите кафедру',
            'level_code'                => 'Укажите уровень',
        ];
    }
}
