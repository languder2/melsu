<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    use SoftDeletes;

    public static $FormMessage = [
        'post' => 'Укажите должность',
        'lastname' => 'Укажите фамилию',
        'firstname' => 'Укажите имя',
    ];
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
        'deleted_at'
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

    public static function getByID($id): ?Staff
    {
        $staff = self::find($id);

        if (isset($staff->works) && !is_null($staff->works))
            $staff->works = json_decode($staff->works);

        return $staff;
    }


    public static function getListForSelect(): Collection
    {
        return self::orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middle_name')
            ->select('id', DB::raw('CONCAT(lastname, " ", firstname, " ", middle_name ) as fio'))
            ->get();

    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->lastname} {$this->firstname} {$this->middle_name}");
    }

    public function getBirthdayFormatedAttribute(): string|null
    {

        if (!$this->birthday)
            return null;

        Carbon::setLocale('ru');

        $date = Carbon::createFromFormat('Y-m-d', $this->birthday);

        return $date->isoFormat('D MMMM YYYY');
    }

    public function getWorkListAttribute(): array|null
    {
        Carbon::setLocale('ru');

        if (!$this->works)
            return null;

        $works = json_decode($this->works);

        foreach ($works as $work) {
            $work->years = '';

            if ($work->employment)
                $work->years .= Carbon::createFromDate($work->employment)->format('Y');

            if ($work->dismissal) {

                if (strlen($work->years) > 0)
                    $work->years .= ' - ';

                $work->years .= Carbon::parse($work->dismissal)->format('Y');
            }
        }

        return $works;
    }

    public function getAvatarSrcAttribute(): string
    {

        $path = 'images/photo/';

        if (!$this->photo)
            return asset($path . 'avatar.webp');

        return file_exists($path . "600x600_{$this->photo}.jpg")
            ? asset($path . "600x600_{$this->photo}.jpg")
            : asset($path . 'avatar.webp');

    }

}
