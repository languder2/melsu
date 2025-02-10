<?php

namespace App\Models\Department;

use App\Models\Department\Department as Department;
use App\Models\Staff\Staff as GlobalStaff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'department_staffs';

    protected $fillable = [
        'id',
        'staff',
        'department',
        'post',
        'sort',
        'deleted_at'
    ];


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function getLinkAttribute(): string
    {
        return url("staff/" . ($this->alias ?? $this->id));
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(GlobalStaff::class, 'staff', 'id');
    }

}
