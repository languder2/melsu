<?php

namespace App\Models\Education;

use App\Models\Education\Department as Department;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'total_places',
        'favorite',
        'description',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'code' => "required|unique:education_specialities,code,$id,id,deleted_at,NULL",
            'spec_code' => "required",
            'faculty_code' => 'required',
            'department_code' => 'required',
            'level_code' => 'required',
            'total_places' => '',
            'favorite' => '',
            'description' => '',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
            'spec_code' => "Код специальности должен быть указан",
            'faculty_code' => 'Укажите факультет',
            'department_code' => 'Укажите кафедру',
            'level_code' => 'Укажите уровень',
        ];
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_code', 'code');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'code');
    }

    public function getPlacesAttribute(): int
    {
        return $this->profiles()->pluck('places')->sum();
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'speciality_code', 'code');
    }

    public function logo(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation')->where('type', 'logo');
    }

}
