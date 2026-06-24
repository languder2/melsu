<?php

namespace App\Models\Education;

use App\Enums\EducationLevel;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Gallery\Image;
use App\Models\Minor\Career;
use App\Models\Page\Content as PageContent;
use App\Models\Sections\FAQ;
use App\Traits\Documents\hasDocuments;
use App\Traits\hasInfos;
use App\Traits\hasOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Speciality extends Model
{
    use SoftDeletes, hasOptions, hasInfos, hasDocuments;
    protected $table = 'education_specialities';

    protected $with = ['divisions', 'profiles', 'recruitmentProfiles'];

    protected $fillable = [
        'name',
        'name_profile',
        'code',
        'spec_code',
        'institute_id',
        'faculty_id',
        'department_id',
        'level',
        'courses',
        'favorite',
        'description',
        'sort',
        'show',
        'is_recruitment',
    ];

    public const Path = 'specialities';

    protected $casts = [
        'level' => EducationLevel::class
    ];

    public function resolveRouteBinding($value, $field = null): ?Speciality
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->profiles->each(fn($item) => $item->delete());
        });

        static::saving(function ($item) {
            if ($item->isDirty('department_id')) {
                if (empty($item->department_id)) {
                    $item->faculty_id = null;
                    $item->institute_id = null;
                    return;
                }

                $department = Division::find($item->department_id);

                if ($department) {
                    $ancestors = $department->ancestors()
                        ->select('id', 'type')
                        ->get()
                        ->mapWithKeys(function ($division) {
                            return [
                                $division->getRawOriginal('type') => $division->id
                            ];
                        });

                    $item->faculty_id = $ancestors->get('faculty');
                    $item->institute_id = $ancestors->get('institute');
                }
            }

            if($item->isDirty('is_recruitment'))
                $item->is_recruitment = (bool) $item->is_recruitment;

            if($item->isDirty('show'))
                $item->is_recruitment = (bool) $item->show;

        });

        static::saved(function ($item) {
        });
    }

    public function relation():MorphTo
    {
        return $this->morphTo();
    }

    public function divisions():BelongsToMany
    {
        return  $this->belongsToMany(Division::class, 'edu_speciality_division_links', 'speciality_id', 'division_id');
    }

    public function ico(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'ico');
    }
    public function sections(bool $public = true): MorphMany
    {

        $result = $this->morphMany(PageContent::class, 'relation')->orderBy('order');

        if($public)
            $result->where('show',true);

        return $result;
    }
    public function faq($public = false): MorphMany
    {

        $result = $this->morphMany(FAQ::class, 'relation');

        if($public)
            $result->where('show', true);

        return $result->orderBy('order');
    }

    public function career($public = true): MorphMany
    {

        $result = $this->morphMany(Career::class, 'relation');

        if($public)
            $result->where('is_show', true);

        return $result->orderBy('sort', 'desc');
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'speciality_id', 'id');
    }
    public function profilesByType(): Collection
    {
        return $this->profiles->keyBy(fn($item) => $item->form->name);
    }
    public function recruitmentProfiles(): HasMany
    {
        return $this->profiles()->where('is_recruitment', true);
    }
    public function getPublicProfilesAttribute(): Collection
    {
        return $this->profiles()->where('show', true)->get();
    }
    public function getRecruitmentProfilesAttribute(): Collection
    {
        return $this->profiles()
            ->where('is_recruitment', true)
            ->where('show', true)
            ->get();
    }
    public function profileByForm($form,$public=false): ?Profile
    {
        $result = $this->profiles();

        if($public)
            $result->where('show',true);

        return  $result->firstWhere('form', $form)?? null;
    }

    public function getLinkAttribute(): string
    {
        return route('public:education:speciality',$this->code ?? $this->id);
    }

    public static function updateAffiliation(?Speciality $speciality,?Division $division):void
    {
        if(!$speciality || !$division || !$division->type->getSpecialityFiled()) return;

        $speciality->fill([$division->type->getSpecialityFiled() => $division->id])->save();

        if($division->parent)
            self::updateAffiliation($speciality,$division->parent);
    }

    public function getNameWithProfileAttribute(): string
    {
        return $this->name_profile ? "{$this->name} ($this->name_profile)" : $this->name;
    }

    public function curriculum(?string $form = null, bool $public = false):Collection
    {
        $query = $this->documents()->orderBy('sort');

        if($public)
            $query->where('is_show',true);

        $list =  $query->get();

        $list = $list->filter(function ($item){
            return $item->type === 'curriculum';
        });

        if($form)
            $list = $list->filter(function ($item) use ($form){
                return $item->SpecialityForm === $form;
            });

        return $list;
    }

    public function postSaveMaintenance():void
    {
        $this->isRecruitmentBasedOnFormRecruitment();
    }

    /* service */
    public function isRecruitmentBasedOnFormRecruitment(): bool
    {
        $this->is_recruitment = !$this->public_profiles->where('is_recruitment',true)->isEmpty();

        $this->save();

        return $this->is_recruitment;
    }
    public function scopeIsShow(Builder $query): Builder
    {
        return $query->where('show',true);
    }

    public static function eduNir(): Collection
    {
        return self::with('infos')->isShow()->get()
            ->map(fn($item) => [
                'id'                => $item->id,
                'spec_code'         => $item->spec_code,
                'spec_name'         => $item->name,
                'spec_profile'      => $item->name_profile,
                'level_name'        => $item->level->fullName(),

                'perechenNir'       => $item->getInfoValueByCode('perechenNir'),
                'napravNir'         => $item->getInfoValueByCode('napravNir'),
                'resultNir'         => $item->getInfoValueByCode('resultNir'),
                'baseNir'           => $item->getInfoValueByCode('baseNir'),
            ]
        );
    }

    public static function graduateJob(): Collection
    {
        return self::with('infos')->isShow()->get()
            ->map(fn($item) => [
                'id'                => $item->id,
                'spec_code'         => $item->spec_code,
                'spec_name'         => $item->name,
                'spec_profile'      => $item->name_profile,

                'v1'                => $item->getInfoValueByCode('v1'),
                't1'                => $item->getInfoValueByCode('t1'),
            ]
        );
    }

}
