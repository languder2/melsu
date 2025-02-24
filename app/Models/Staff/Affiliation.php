<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Affiliation extends Model
{

    use SoftDeletes;
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

    public function getOrderAttribute($order): int|null
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

}
