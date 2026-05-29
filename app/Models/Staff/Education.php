<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    protected $fillable = [
        'staff_id',
        'university',
        'year',
        'type',
        'level',
        'speciality',
        'is_show',
        'order'
    ];

    protected $table    = 'staff_education';

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

}
