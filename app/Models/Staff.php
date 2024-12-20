<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Staff extends Model
{
    use SoftDeletes;

    protected $table        = 'staffs';
    protected $fillable     = [
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

    public static $FormRules = [
        'post'              => 'required',
        'lastname'          => 'required',
        'firstname'         => 'required',
        'middle_name'       => '',
        'birthday'          => '',
        'birthplace'        => '',
        'residence'         => '',
        'education'         => '',
        'awards'            => '',
        'affiliation'       => '',
        'family_status'     => '',
        'title'             => '',
        'reception_time'    => '',
        'phones'            => '',
        'emails'            => '',
        'address'           => '',
        'works'             => '',
        'alias'             => 'nullable|unique:staffs,alias',
    ];

    public static $FormMessage = [
        'post'              => 'Укажите должность',
        'lastname'          => 'Укажите фамилию',
        'firstname'         => 'Укажите имя',
    ];

    public static function getByID($id): ?Staff
    {
        $staff = self::find($id);

        if(isset($staff->works) && !is_null($staff->works))
            $staff->works = json_decode($staff->works);

        return $staff;
    }

}
