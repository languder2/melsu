<?php

namespace App\Models\Education;

use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\Info\Types;
use App\Enums\Info\Vacant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Global\Options, Info\Info, Link, Sections\FAQ, Staff\Affiliation};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Models\Documents\Document;

/**
 * @method static find(int $int)
 */
#[\AllowDynamicProperties] class Profile extends Model
{
    use SoftDeletes;
    public const string Path = 'documents/education/profile';

    protected $table = 'education_profiles';

    protected $fillable = [
        'id',
        'alias',
        'speciality_id',
        'speciality_code',
        'form',
        'duration',
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
            'duration'          => '',
            'years'             => 'nullable|numeric',
            'months'            => 'nullable|numeric',
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

            if(array_key_exists('duration', $attributes))
                $attributes['duration'] = $attributes['duration'] === 0 ? null : $attributes['duration'];

            if(array_key_exists('afc', $attributes))
                $attributes['afc']              = (bool) ($attributes['afc']);
        }

        return parent::fill($attributes);
    }


    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }

    public function getDocuments(): MorphMany
    {
        return $this->morphMany(Document::class, 'relation');
    }
    public function documents(): Collection
    {
        return $this->getDocuments;
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

//    public function duration($type = null, bool $record = false): MorphMany|Duration|int|null
//    {
//        if (!$type)
//            return $this->morphMany(Duration::class, 'relation');
//
//        if (!$type instanceof DurationType)
//            $type = DurationType::tryFrom($type);
//
//        $result = $this->morphMany(Duration::class, 'relation')->where('type', $type)->first();
//
//        return $record ? $result : $result->duration ?? null;
//    }

    public function years($type = null): ?int
    {
        return intdiv($this->duration($type),12);
    }
    public function months($type = null): ?int
    {
        return $this->duration($type) % 12;
    }

    public function getMonthsAttribute(): int
    {
        return $this->duration % 12;
    }
    public function getYearsAttribute(): int
    {
        return intdiv($this->duration,12);
    }

    public function durationYear($full = true): string
    {
        return $full
            ? match(true){
                $this->years === 1  => $this->years.__('duration-append.year-one'),
                $this->years > 4    => $this->years.__('duration-append.year-many'),
                default             => $this->years.__('duration-append.year-some'),
            }
            : $this->years.__('duration-append.short-year');
    }

    public function durationMonth($full = true): string
    {
        if(!$this->months)  return '';

        return $full
            ? match(true){
                $this->months === 1 => $this->months.__('duration-append.month-one'),
                $this->months > 4   => $this->months.__('duration-append.month-many'),
                default             => $this->months.__('duration-append.month-some'),
            }
            : $this->months.__('duration-append.short-month');
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

    public function places(): MorphMany
    {
        return $this->morphMany(Place::class, 'relation');
    }

    public function placesByType($code): ?int
    {
        return $this->places()->where('type', $code)->first()->count ?? null;
    }

    public function budgetPlaces(): ?Place
    {
        return $this->places->where('type', EducationBasis::Budget)->first();
    }

    public function getBudgetPlacesAttribute(): ?int
    {
        return $this->budgetPlaces()->count ?? null;
    }

    public function contractPlaces(): ?Place
    {
        return $this->places->firstWhere('type', EducationBasis::Contract)->first();
    }

    public function getContractPlacesAttribute(): ?int
    {
        return $this->contractPlaces()->count ?? null;
    }

    public function showByBasis($basis):bool
    {
        return $this->scoreByType($basis)
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


            $form['show']   = array_key_exists('show', $form);

            $profile = self::firstOrCreate(
                [
                    'speciality_id'     => $object->id,
                    'speciality_code'   => $object->code,
                    'form' => $form['form']
                ],
                [
                    'alias' => "{$object->code}-{$form['form']}",
                ]
            );

            $form['duration'] = (int) $form['years'] * 12 + (int) $form['months'];

            $profile->fill($form)->save();

            foreach($form['score'] as $type=>$count){
                if(!$count) continue;

                $score = $profile->score->where('type',$type)->first() ?? $profile->score()->create(['type'=>$type]);

                $score->fill(['score'=>$count])->save();
            }

            foreach ($form['places'] as $type => $count)
                $profile->places()->firstOrCreate(['type'=>$type])->fill(['count'=>$count])->save();

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

    public function formatedDuration($full = true): ?string
    {
        if( !$this->duration ) return null;

        return trim($this->durationYear($full)." ".$this->durationMonth($full));
    }

    public function info(): MorphMany
    {
        return $this->morphMany(Info::class,'relation');
    }

    public function getInfoByCode($code): ?Info
    {
        return $this->info->where('code',$code)->first() ?? (new Info(['code' => $code]))->relation()->associate($this);
    }
    public function getInfoByTypeCode($type,$code): ?Info
    {
        return $this->info->where('code',$code)->first();
    }
    public function getInfos(): Collection
    {
        return $this->info->get()->keyBy('code');
    }
    public function getInfosByType($type): Collection
    {
        return $this->info->where('type',$type)->get()->keyBy('code');
    }
    public function getInfoContent($code): string|int|null
    {
        return $this->info->where('code',$code)->first()->content ?? null;
    }

    public function getCourses($type, $code, int $course): Collection
    {
        return $this->getInfosByType($type)->where('code',$code);
    }
    public function getCourse(int $course): ?Info
    {
        return
            $this->info
                ->where('type',Types::vacant)
                ->where('code',Vacant::eduCourse)
                ->where('content',$course)
                ->first()
        ?? new Info([
            'type'      => Types::vacant,
            'code'      => Vacant::eduCourse,
            'content'   => $course
        ]);
    }

    public function getOption($option):Options
    {
        return $this->options()->where('code',$option)->first()
            ?? (new Options(['code' => $option]))->relation()->associate($this);
    }


}
