<?php

namespace App\Models\Education;

use App\Enums\EducationBasis;
use App\Enums\EducationLevel;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use App\Models\Info\Info;
use App\Models\Page\Content as PageContent;
use App\Models\Sections\Career;
use App\Models\Sections\FAQ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Speciality extends Model
{
    use SoftDeletes;

    protected $table = 'education_specialities';

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

    public static function FormRules($id): array
    {
        return [
//            'test'              => 'required',
            'name'              => 'required',
            'name_profile'      => '',
            'code'              => "required|unique:education_specialities,code,$id,id,deleted_at,NULL",
            'spec_code'         => "required",
            'faculty_id'        => '',
            'department_id'     => '',
            'level'             => 'required',
            'favorite'          => '',
            'description'       => '',
            'sort'              => 'nullable|numeric',
            'show'              => '',
            'is_recruitment'    => 'boolean|nullable',
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

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){

            if(array_key_exists('is_recruitment', $attributes))
                $attributes['is_recruitment'] = (bool) $attributes['is_recruitment'];

            if(array_key_exists('show', $attributes))
                $attributes['show'] = (bool) $attributes['show'];
        }

        return parent::fill($attributes);
    }

    public function relation():MorphTo
    {
        return $this->morphTo();
    }

    public function getIdAttribute($value):int
    {
        return $value ?? now()->format('Uv');
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
            $result->where('active', true);

        return $result->orderBy('sort');
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'speciality_id', 'id');
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

    public function documents():MorphMany
    {
        return $this->morphMany(Document::class,'relation')->orderBy('sort')->whereNull('parent_id');
    }

    public function publicDocuments():Collection
    {
        return $this->documents()->where('is_show',true)->get();
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

    /* Links */

    public function getAdminAttribute():string
    {
        return  route('admin:speciality:list');
    }

    public function getFormAttribute():string
    {
        return  route('speciality:admin:form',$this->exists ? $this->id : null);
    }
    public function getSaveAttribute():string
    {
        return  route('speciality:save',$this->exists ? $this->id : null);
    }

    /* end Links */

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

    public function options(): MorphMany
    {
        return $this->morphMany(Options::class, 'relation');
    }
    public function option(string $code): Options
    {
        return $this->options()->where('code',$code)->first()
            ?? (new Options(['code' => $code]))->relation()->associate($this);
    }
    public function optionValue(string $code): ?string
    {
        return $this->option($code)->property;
    }

    public function infos(): MorphMany
    {
        return $this->morphMany(Info::class, 'relation');
    }
    public function info(): MorphMany
    {
        return $this->morphMany(Info::class,'relation');
    }

    public function getInfoByCode($code): ?Info
    {
        return $this->info->where('code',$code)->first() ?? (new Info(['code' => $code]))->relation()->associate($this);
    }

}
