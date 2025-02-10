<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $table = 'education_levels';

    protected $fillable = [
        'id',
        'name',
        'alt_name',
        'code',
        'sort',
        'created_at',
        'deleted_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alt_name' => '',
            'code' => "required|unique:education_levels,code,{$id},id,deleted_at,NULL",
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
