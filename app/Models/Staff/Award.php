<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use SoftDeletes;

    protected $table = 'staff_awards';

    protected $fillable = [
        'staff_id',
        'year',
        'award',
        'order',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }
}
