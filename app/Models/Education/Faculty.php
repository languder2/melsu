<?php

namespace App\Models\Education;

use App\Models\Education\Department as EducationDepartment;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'code' => "required|unique:education_faculties,code,{$id},id,deleted_at,NULL",
            'description' => '',
            'order' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

    public function departments(): HasMany
    {
        return $this->hasMany(EducationDepartment::class, 'faculty_code', 'code')
            ->orderBy('order', 'desc')
            ->orderBy('name');
    }

    public function specialities(): HasMany
    {
        return $this->hasMany(Speciality::class, 'faculty_code', 'code')
            ->orderBy('order', 'desc')
            ->orderBy('spec_code');
    }

    public function getOrderAttribute(?int $value): int|null
    {
        return ($value === 10000) ? null : $value;
    }

    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function logo(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'logo');
    }
}


