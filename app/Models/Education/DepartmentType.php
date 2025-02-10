<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentType extends Model
{
    use SoftDeletes;

    protected $table = 'education_department_types';

    protected $fillable = [
        'id',
        'name',
        'code',
        'sort',
        'deleted_at',
        'created_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'code' => "required|unique:education_department_types,code,{$id},id,deleted_at,NULL",
            'description' => '',
            'sort' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
        ];
    }

}
