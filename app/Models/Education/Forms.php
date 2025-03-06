<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forms extends Model
{
    use SoftDeletes;

    protected $table = 'education_forms';

    protected $fillable = [
        'id',
        'name',
        'alt_name',
        'code',
        'sort',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alt_name' => '',
            'code' => "required|unique:education_forms,code,{$id},id,deleted_at,NULL",
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
