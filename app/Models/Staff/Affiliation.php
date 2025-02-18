<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Affiliation extends Model
{

    protected $table = 'staff_affiliation';

    protected $fillable = [
        'type',
        'staff_id',
        'alt_name',
        'post',
        'order',
        'show',
    ];
    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
    public function card(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id','id');
    }

    public function setOrderAttribute($value): void
    {
        $this->attributes['order'] = $value ?? 10000;
    }

}
