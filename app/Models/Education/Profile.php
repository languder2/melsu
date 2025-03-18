<?php

namespace App\Models\Education;

use App\Enums\EducationForm;
use App\Models\{Document, FAQ, Link};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'education_profiles';

    protected $fillable = [
        'id',
        'alias',
        'speciality_code',
        'form',
        'duration',
        'total_places',
        'director',
        'address',
        'afc',
        'price',
        'show',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'form'  => EducationForm::class,
    ];

    public static function FormRules($id): array
    {
        return [
            'alias' => "required|unique:education_profiles,alias,{$id},id,deleted_at,NULL",
            'description' => '',
            'speciality_code' => '',
            'form' => '',
            'duration' => '',
            'total_places' => 'nullable|numeric',
            'director' => '',
            'address' => '',
            'afc' => 'boolean',
            'show' => 'boolean',
            'price' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'alias.required' => 'Alias должен быть указан',
            'alias.unique' => 'Alias должен быть уникальным',
            'places' => 'Кол-во мест должно быть цифровым значением',
            'scores' => 'Кол-во баллов должно быть цифровым значением',
            'price' => 'Цена должна быть цифровым значением',
            'afc' => 'AFC must be boolean',
        ];
    }

    public function documents($all = null, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Document::class, 'relation');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();


        return $object;
    }

    public function faq($all = null, $trashed = null): MorphMany
    {
        $object = $this->morphMany(FAQ::class, 'relation');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }

    public function links($all = null, $trashed = null): MorphMany
    {
        $object = $this->morphMany(Link::class, 'relation');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }

    public function staffs($all = null, $trashed = null): MorphMany
    {
        $object = $this->morphMany(StaffAffiliation::class, 'relation')->with('staff');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }

    public function getBudgetScoreAttribute(): int
    {
        return $this->exams()->where('type', 'budget')->where('year', 2024)->get()->pluck('score')->sum();
    }

    public function exams($all = null, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Exam::class, 'relation');

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }

    public function getBudgetPlacesAttribute(): int|string
    {
        return $this->places()->where('type', 'budget')->first()->count ?? "&nbsp;";
    }

    public function places($all = null, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Place::class, 'relation');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }

    public function getBudgetScoresAttribute(): int|string
    {
        return $this->exams()
            ->where('type', 'budget')
            ->get()
            ->pluck('score')
            ->sum()
            ?? "&nbsp;";
    }

}
