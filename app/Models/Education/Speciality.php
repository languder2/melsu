<?php

namespace App\Models\Education;

use App\Enums\EducationBasis;
use App\Enums\EducationLevel;
use App\Models\Division\Division;
use App\Models\Gallery\Image;
use App\Models\Page\Content as PageContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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
        'faculty_id',
        'department_id',
        'level',
        'favorite',
        'description',
        'sort',
        'show',
    ];

    protected $casts = [
        'level' => EducationLevel::class
    ];

    public static function FormRules($id): array
    {
        return [
//            'test'              => 'required',
            'name'              => 'required',
            'code'              => "required|unique:education_specialities,code,$id,id,deleted_at,NULL",
            'spec_code'         => "required",
            'faculty_id'        => '',
            'department_id'     => '',
            'level'             => 'required',
            'favorite'          => '',
            'description'       => '',
            'sort'              => 'nullable|numeric',
            'show'              => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
            'spec_code' => "Код специальности должен быть указан",
            'level' => 'Укажите уровень',
        ];
    }

    public function relation():MorphTo
    {
        return $this->morphTo();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'department_id', 'id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'faculty_id', 'id');
    }

    public function ico(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'ico');
    }
    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation')->orderBy('order');
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'speciality_code', 'code');
    }
    public function profileByForm($form): ?Profile
    {
        return $this->profiles()->firstWhere('form', $form) ?? null;
    }

    public function getPlacesAttribute(): int
    {
        $places = 0;

        foreach ($this->profiles as $profile)
            $places += $profile->placesByType(EducationBasis::Budget);

        return $places;
    }


}
