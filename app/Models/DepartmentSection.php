<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentSection extends Model
{
    use SoftDeletes;

    protected $table        = 'department_sections';

    protected $fillable     = [
        'id',
        'department',
        'name',
        'show_title',
        'text',
        'sort',
        'deleted_at'
    ];
}
