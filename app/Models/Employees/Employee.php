<?php

namespace App\Models\Employees;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'staff_id',
        'teachingDiscipline',
        'teachingLevel',
        'degree',
        'academStat',
        'qualification',
        'profDevelopment',
        'specExperience',
        'teachingOp',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

}
