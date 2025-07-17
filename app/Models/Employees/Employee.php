<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'fio',
        'post',
        'teachingDiscipline',
        'teachingLevel',
        'degree',
        'academStat',
        'qualification',
        'profDevelopment',
        'specExperience',
        'teachingOp',
    ];
}
