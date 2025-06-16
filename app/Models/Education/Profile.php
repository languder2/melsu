<?php

namespace App\Models\Education;

use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Link, Sections\FAQ, Staff\Affiliation};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Models\Documents\Document;

/**
 * @method static find(int $int)
 */
class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'education_profiles';

    protected $fillable = [
        'id',
        'alias',
        'speciality_id',
        'speciality_code',
        'form',
        'total_places',
        'director',
        'address',
        'afc',
        'price',
        'show',
        'is_recruitment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'form' => EducationForm::class,
    ];

    public static function FormRules($id): array
    {
        return [
            'alias'             => "required|unique:education_profiles,alias,{$id},id,deleted_at,NULL",
            'description'       => '',
            'speciality_id'     => '',
            'speciality_code'   => '',
            'form'              => '',
            'total_places'      => 'nullable|numeric',
            'director'          => '',
            'address'           => '',
            'afc'               => 'boolean',
            'show'              => 'boolean',
            'is_recruitment'    => 'boolean',
            'price'             => 'nullable|numeric',
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

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){

            if(array_key_exists('is_recruitment', $attributes))
                $attributes['is_recruitment']   = (bool) $attributes['is_recruitment'];

            if(array_key_exists('show', $attributes))
                $attributes['show']             = (bool) $attributes['show'];

            if(array_key_exists('afc', $attributes))
                $attributes['afc']              = (bool) ($attributes['afc']);
        }

        return parent::fill($attributes);
    }


    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_code', 'code');
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

    public function duration($type = null, bool $record = false): MorphMany|Duration|int|null
    {
        if (!$type)
            return $this->morphMany(Duration::class, 'relation');

        if (!$type instanceof DurationType)
            $type = DurationType::tryFrom($type);

        $result = $this->morphMany(Duration::class, 'relation')->where('type', $type)->first();

        return $record ? $result : $result->duration ?? null;
    }

    public function years($type = null): ?int
    {
        return intdiv($this->duration($type),12);
    }

    public function months($type = null): ?int
    {
            return $this->duration($type) % 12;
    }

    public function durationYear($type = null, $full = true): string
    {
        $duration = $this->years($type);

        if(!$duration)  return '';

        return $full
            ? match(true){
                $duration === 1 => "$duration".__('duration-append.year-one'),
                $duration > 4   => "$duration".__('duration-append.year-many'),
                default         => "$duration".__('duration-append.year-some'),
            }
            : "$duration".__('duration-append.short-year');
    }

    public function durationMonth($type = null, $full = true): string
    {
        $duration = $this->months($type);

        if(!$duration)  return '';

        return $full
            ? match(true){
                $duration === 1 => "$duration".__('duration-append.month-one'),
                $duration > 4   => "$duration".__('duration-append.month-many'),
                default         => "$duration".__('duration-append.month-some'),
            }
            : "$duration".__('duration-append.short-month');
    }

    public function staffs($all = null, $trashed = null): MorphMany
    {
        $object = $this->morphMany(Affiliation::class, 'relation')->with('staff');

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
    public function score(): MorphMany
    {
        return $this->morphMany(Exam::class, 'relation')->whereNull('subject_id');
    }

    public function scoreByType($type): ?int
    {
        return $this->score()->firstWhere('type', $type)->score ?? null;
    }

    public function requiredExamsByType($type):?Collection
    {
        return $this->exams()
            ->where('type', $type)
            ->where('required', '1')
            ->get();
    }

    public function selectableExamsByType($type):?Collection
    {
        return $this->exams()
            ->where('type', $type)
            ->where('required', '0')
            ->where('selectable', '1')
            ->get();
    }

    public function getBudgetPlacesAttribute(): int|string
    {
        return $this->places()->where('type', 'budget')->first()->count ?? "&nbsp;";
    }

    public function places($all = null, $trashed = null): MorphMany
    {

        $result = $this->morphMany(Place::class, 'relation');

        if (is_null($all))
            $result->where('show', true);

        if (!is_null($trashed))
            $result->withTrashed();

        return $result;
    }

    public function placesByType($type):?int
    {
        return $this->places()->firstWhere('type', $type)->count ?? null;
    }

    public function showByBasis($basis):bool
    {
        return $this->scoreByType($basis)
//            || $this->placesByType($basis)
            || $this->requiredExamsByType($basis)->count()
            || $this->selectableExamsByType($basis)->count();
    }

    public function showDualBasis():bool
    {
        return $this->showByBasis(EducationBasis::Budget) && $this->showByBasis(EducationBasis::Contract);
    }


    public static function processing($object,$list):void
    {

        foreach ($list as $educationForm => $form) {

            $form['show']           = array_key_exists('show', $form);

            $profile = self::firstOrCreate(
                [
                    'speciality_code' => $object->code,
                    'form' => $form['form']
                ],
                [
                    'alias' => "{$object->code}-{$form['form']}",
                ]
            );

            $profile->fill($form)->save();


            Duration::processing($profile,$form['duration']);


            foreach($form['score'] as $type=>$count){
                if(!$count) continue;

                $score = $profile->score->where('type',$type)->first() ?? $profile->score()->create(['type'=>$type]);

                $score->fill(['score'=>$count])->save();
            }

            foreach ($form['places'] as $type => $count) {
                $place = $profile->places->where('type', $type)->first() ?? $profile->places()->create(['type' => $type]);
                $place->fill(['count'=>$count])->save();
            }

            foreach ($form['exams'] as $type => $list) {
                foreach ($list as $subject_id => $item) {
                    $exam = $profile->exams()->where([
                        'type' => $type,
                        'subject_id' => $subject_id,
                    ])->first();

                    if (!$exam)
                        $exam = $profile->exams()->create([
                            'type' => $type,
                            'subject_id' => $subject_id,
                        ]);

                    if (!isset($item['required']))
                        $item['required'] = false;

                    if (!isset($item['selectable']) || $item['required'])
                        $item['selectable'] = false;

                    $exam->fill($item)->save();
                }
            }
        }
    }

    public function getFormatedPriceAttribute(): ?string
    {
        return  $this->price
            ? number_format($this->price, 0, ',', ' ') . ' ₽'
            : null;
    }

    public function formatedDuration(DurationType $type, $full = true): ?string
    {
        if( !$this->duration($type) ) return null;

        return trim($this->durationYear($type, $full)." ".$this->durationMonth($type, $full));
    }
    public function getFormatedDurationOOOAttribute(): ?string
    {
        return  $this->formatedDuration(DurationType::OOO);
    }
    public function getFormatedDurationSOOAttribute(): ?string
    {
        return  $this->formatedDuration(DurationType::SOO);
    }

    public function getShortFormatedDurationOOOAttribute(): ?string
    {
        return  $this->formatedDuration(DurationType::OOO,false);
    }
    public function getShortFormatedDurationSOOAttribute(): ?string
    {
        return  $this->formatedDuration(DurationType::SOO,false);
    }

}
