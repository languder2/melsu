<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';

    protected $fillable = [
        'id',
        'photo',
        'post',
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
        'works',
        'link',
        'alias',
    ];

    public static function FormRules($id): array
    {
        return [
            'post' => 'required',
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
            'works' => '',
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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->lastname} {$this->firstname} {$this->middle_name}");
    }

    public function getAvatarSrcAttribute(): string
    {

        $path = 'images/photo/';

        if (!$this->photo)
            return asset($path . 'avatar.webp');

        return file_exists(public_path($path . "600x600_{$this->photo}.jpg"))
            ? asset($path . "600x600_{$this->photo}.jpg")
            : asset($path . 'avatar.webp');

    }

}
