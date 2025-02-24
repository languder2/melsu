<?php

namespace App\Models\Education;

use App\Models\Education\Department as EducationDepartment;
use App\Models\Gallery\Image;
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
        'name',
        'code',
        'description',
        'order',
        'show',
    ];

    public static function FormRules($id): array
    {
        return [
            'acronym'       => 'nullable',
            'name'          => 'required',
            'code'          => "required|unique:education_faculties,code,{$id},id,deleted_at,NULL",
            'description'   => '',
            'order'         => 'nullable|numeric',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'preview'       => '',
            'show'          => '',
            'staffs'        => '',
            'chief'         => '',
            'chief_post'    => '',
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

    public function getOrderAttribute($order): int|null
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function logo(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'logo');

        if(!$image->count())
            $image->create([
                'type'      => 'logo',
                'name'      => $this->name,
            ])->save();

        return $image;

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


}


