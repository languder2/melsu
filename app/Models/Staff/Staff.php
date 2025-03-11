<?php

namespace App\Models\Staff;

use App\Models\Division\Division;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Staff\Post;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';

    protected $fillable = [
        'id',
        'photo',
        'lastname',
        'firstname',
        'middle_name',
        'birthday',
        'birthplace',
        'residence',
        'education',
        'awards',
        'affiliation',
        'family_status',
        'title',
        'titles',
        'reception_time',
        'phones',
        'emails',
        'address',
        'link',
        'alias',
    ];

    public static function FormRules($id): array
    {
        return [
            'lastname' => 'required',
            'firstname' => 'required',
            'middle_name' => '',
            'birthday' => '',
            'birthplace' => '',
            'residence' => '',
            'education' => '',
            'awards' => '',
            'affiliation' => '',
            'family_status' => '',
            'title' => '',
            'reception_time' => '',
            'phones' => '',
            'emails' => '',
            'address' => '',
            'posts' => '',
            'alias' => "nullable|unique:staffs,alias,{$id},id,deleted_at,NULL",
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'post' => 'Укажите должность',
            'lastname' => 'Укажите фамилию',
            'firstname' => 'Укажите имя',
        ];
    }

    public function getLinkAttribute(): string
    {
        return url("staffs/" . ($this->alias ?? $this->id));
    }

    public function getWorksAttribute($value): array
    {

        return $value?json_decode($value):[];
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->lastname} {$this->firstname} {$this->middle_name}");
    }

    public function avatar(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'avatar');

        if(!$image->count())
            $image->create([
                'type'      => 'avatar',
                'name'      => 'avatar',
            ])->save();

        return $image;
    }

    public function posts():MorphMany
    {
        return $this->MorphMany(Post::class, 'relation');
    }
    public function divisions():HasMany
    {
        return $this->hasMany(Division::class,'coordinator_id', 'id')
            ->orderBy('sort')
            ->orderBy('name');
    }


    public static function getOrCreate($id,$full_name):?Staff
    {
        $staff = Staff::find($id);

        if(!$staff && !$full_name) return null;

        $fullName = explode(' ',$full_name);

        $staff = Staff::firstOrCreate(
            [
                'lastname'          => $fullName[0] ?? null,
                'firstname'         => $fullName[1] ?? null,
                'middle_name'       => $fullName[2] ?? null,
            ],
        );

        return $staff;
    }

    public function AffiliationPosts():HasMany
    {
        return $this->hasMany(Affiliation::class,'staff_id', 'id');
    }


}
