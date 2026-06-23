<?php

namespace App\Models\Education;

use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\Info\Types;
use App\Enums\Info\Vacant;
use App\Traits\hasOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Global\Options, Info\Info, Link, Sections\FAQ};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Models\Documents\Document;

/**
 * @method static find(int $int)
 */
#[\AllowDynamicProperties] class Profile extends Model
{
    use SoftDeletes, hasOptions;
    public const string Path = 'documents/education/profile';

    protected $table = 'education_profiles';

    protected $with = ['getDocuments.options','places'];

    protected $fillable = [
        'id',
        'speciality_id',
        'form',
        'duration',
        'director',
        'address',
        'afc', // Прием иностранных граждан
        'price',
        'show',
        'is_recruitment', // ведется прием на данный профиль
    ];
    protected $casts = [
        'form'              => EducationForm::class,
        'show'              => 'boolean',
        'is_recruitment'    => 'boolean',
        'afc'               => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->places->each(fn($item) => $item->delete());
        });
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }

    public function documents(): Collection
    {
        return $this->getDocuments;
    }

    public function getDocuments(): MorphMany
    {
        return $this->morphMany(Document::class, 'relation')->with('options');
    }
    public function documentsWithOptionValue(string $value): array
    {
        return $this->getDocuments
            ->filter(fn($doc) => $doc->options->contains('property', $value))
            ->map(fn($doc) => ['link' => $doc->link, 'title' => $doc->title])
            ->values()->all();
    }
    public function documentsByCodes():Collection
    {
        return $this->getDocuments
            ->whereNotNull('code')
            ->where('code', '!==', '')
            ->groupBy('code')
            ->map(fn(Collection $group) => $group->keyBy('id'));
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

    public function years($type = null): ?int    {
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

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'profile_id');
    }

    public function placesByType($type): Place
    {
        return $this->places()->firstOrNew(['type' => $type]);
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

            $profile = self::firstOrNew([
                'speciality_id'     => $object->id,
                'form' => $form['form']
            ]);

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
        return $this->info()->firstOrNew(['code' => $code]);
    }
    public function getInfos(): Collection
    {
        return $this->info->keyBy('code');
    }
    public function getInfosByType($type): Collection
    {
        return $this->info()->where('type',$type)->get()->keyBy('code');
    }
    public function getInfoContent($code): ?string
    {
        return $this->info()->firstOrNew(['code' => $code])->content;
    }

    public function getCourses($type, $code, int $course): Collection
    {
        return $this->getInfosByType($type)->where('code',$code);
    }
    public function getCourse(int $course): ?Info
    {
        return $this->info->firstOrNew([
                'type'      => Types::vacant,
                'code'      => Vacant::eduCourse,
                'content'   => $course
        ]);
    }

    public function getOption($code):Options
    {
        return $this->options()->firstOrNew(['code' => $code]);
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('show', true);
    }

    public static function eduOp(): Collection
    {
        return self::with([
            'speciality',
            'getDocuments',
            'getDocuments.options'
        ])
            ->whereHas('speciality')
            ->public()
            ->get()
            ->map(function ($profile) {
                return [
                    'spec_code'             => $profile->speciality->spec_code,
                    'spec_name'             => $profile->speciality->name,
                    'spec_profile'          => $profile->speciality->name_profile,
                    'level_alt_name'        => $profile->speciality->level?->getAltName() ?? '',
                    'form_name'             => $profile->form?->getName() ?? '',
                    'duration'              => $profile->formatedDuration(),
                    'opMain'                => $profile->documentsWithOptionValue('opMain'),
                    'educationPlan'         => $profile->documentsWithOptionValue('educationPlan'),
                    'educationRpd'          => $profile->documentsWithOptionValue('educationRpd'),
                    'educationShedule'      => $profile->documentsWithOptionValue('educationShedule'),
                    'eduPr'                 => $profile->documentsWithOptionValue('eduPr'),
                    'methodology'           => $profile->documentsWithOptionValue('methodology'),
                ];
            });
    }

    public static function eduAccred(): Collection
    {
        return self::with([
            'speciality',
            'getDocuments',
            'getDocuments.options'
        ])
            ->whereHas('speciality')
            ->public()
            ->get()
            ->map(fn($profile) => [
                    'spec_code'         => $profile->speciality->spec_code,
                    'spec_name'         => $profile->speciality->name,
                    'spec_profile'      => $profile->speciality->name_profile,
                    'level_alt_name'    => $profile->speciality->level?->getAltName() ?? '',
                    'form_name'         => $profile->form?->getName() ?? '',
                    'duration'          => $profile->formatedDuration(),
                    'eduPredDocs'       => $profile->documentsWithOptionValue('eduPred'),
                    'eduPracDocs'       => $profile->documentsWithOptionValue('eduPrac')
                ]
            );
    }

    public function setPlaces(string $type, ?int $count = null): void
    {
        $places = $this->placesByType($type);

        if(is_null($count) || $count === 0)
            $places->delete();

        else
            $places->fill(['count' => $count])->save();
    }

    public function setAllPlaces(array $places): void
    {
        foreach ($places as $type => $count)
            $this->setPlaces($type, (int)$count);
    }


}
