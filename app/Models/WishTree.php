<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishTree extends Model
{
    public static int $adminPerPage = 20;
    public static $FormRules = [
        'lastname' => 'required',
        'firstname' => 'required',
        'middlename' => '',
        'faculty' => '',
        'speciality' => '',
        'phone' => '',
        'tg' => '',
        'question' => 'required',
        'wish' => 'required',
    ];
    public static $FormMessage = [
    ];
    protected $table = 'wish_tree';
    protected $fillable = [
        'id',
        'lastname',
        'firstname',
        'middlename',
        'faculty',
        'speciality',
        'phone',
        'tg',
        'question',
        'wish',
    ];


}
