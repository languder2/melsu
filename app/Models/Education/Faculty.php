<?php

namespace App\Models\Education;

use App\Models\MenuItems;
use App\Models\Education\Department as EducationDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $table = 'education_faculties';

    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'sort',
        'deleted_at',
        'created_at',
        'deleted_at',
    ];

    public static function FormRules($id):array
    {
        return [
            'name'              => 'required',
            'code'              => "required|unique:education_faculties,code,{$id},id,deleted_at,NULL",
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
        ];
    }


    public function departments(): HasMany
    {
        return $this->HasMany(EducationDepartment::class, 'code','faculty_code');
    }


}


