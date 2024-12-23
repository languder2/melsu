<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Department extends Model
{
    use SoftDeletes;

    protected $table        = 'departments';
    protected $fillable     = [
        'id',
        'name',
        'chief',
        'alias',
        'sort',
        'deleted_at'
    ];

    public static $FormRules = [
//        'name'              => 'required|unique:departments,name,NULL,id,deleted_at,NULL',
        'name'              => 'required|unique:departments,name',
        'chief'             => '',
        'chief_post'        => '',
        'alias'             => '',
        'sort'              => '',
        'sections'          => '',
        'staffs'            => '',
        'documents'         => '',
    ];

    public static $FormMessage = [
        'name.required'     => 'Укажите название',
        'name.unique'       => 'Название уже занято',
    ];

}
