<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'education_departments';

    protected $fillable = [
        'id',
        'name',
        'code',
        'faculty_code',
        'type_code',
        'parent_id',
        'description',
        'sort',
        'created_at',
        'deleted_at',
    ];

    public static function FormRules($id):array
    {
        return [
            'name'              => 'required',
            'code'              => "required|unique:education_departments,code,{$id},id,deleted_at,NULL",
            'faculty_code'      => 'required',
            'type_code'         => 'required',
            'parent_id'         => '',

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
            'faculty.required'          => 'Укажите факультет',
            'type.required'             => 'Укажите тип подразделения',
        ];
    }
}
