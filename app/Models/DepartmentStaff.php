<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentStaff extends Model
{
    use SoftDeletes;

    protected $table        = 'department_staffs';

    protected $fillable     = [
        'id',
        'staff',
        'department',
        'post_alt',
        'sort',
        'deleted_at'
    ];
}
