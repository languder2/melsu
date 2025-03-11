<?php

namespace App\Models\Education;

use App\Models\Contact;
use App\Models\Education\Department as EducationDepartment;
use App\Models\Division\Division;
use App\Models\Gallery\Image;
use App\Models\Page\Content as PageContent;
use App\Models\Staff\Affiliation as StaffAffiliation;
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
        'acronym',
        'type',
        'name',
        'code',
        'description',
        'order',
        'show',
    ];

    public static function FormRules($id): array
    {
        return [
//            'test'              => "required",
            'acronym'           => 'nullable',
            'type'              => '',
            'name'              => 'required',
            'code'              => "required|unique:education_faculties,code,{$id},id,deleted_at,NULL",
            'description'       => '',
            'order'             => 'nullable|numeric',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'preview'           => '',
            'show'              => '',
            'chief'             => '',
            'staffs'            => '',
            'sections'          => '',
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

    public function labs(): HasMany
    {
        return $this->hasMany(EducationDepartment::class, 'faculty_code', 'code')
            ->where('type_code','lab')
            ->orderBy('order', 'desc')
            ->orderBy('name');
    }

    public function specialities(): HasMany
    {
        return $this->hasMany(Speciality::class, 'faculty_code', 'code')
            ->orderBy('order', 'desc')
            ->orderBy('spec_code');
    }

    public function getOrderAttribute($order): int|null
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function preview(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'logo');
    }

    public function staffs($all= false): MorphMany
    {

        $response = $this->morphMany(StaffAffiliation::class, 'relation')->orderBy('order');

        if(!$all)
            $response = $response->where('type','staff');

        return $response;
    }
    public function chief(): MorphOne
    {
        return $this->MorphOne(StaffAffiliation::class, 'relation')->where('type','chief');
    }

    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation');
    }

    public function contacts(?string $type = null): MorphMany
    {
        $query = $this->morphMany(Contact::class, 'relation');

        if($type)
            $query->where('type', $type);

        return $query->orderBy('type')->orderBy('sort');
    }

    public function getLinkAttribute(): string
    {
        return route('public:education:faculty',[
            $this->code ?? $this->id ?? null
        ]);
    }

}


