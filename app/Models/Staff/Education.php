<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table    = 'staff_education';

    protected $fillable = [
        'staff_id',
        'university',
        'type',
        'level',
        'speciality',
        'is_show',
        'order'
    ];
}
