<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{

    use SoftDeletes;

    protected $table = 'partners';

    protected $fillable = [
        'name',
        'is_show',
        'sort'
    ];

    protected $casts = [
        'show_title' => 'boolean',
        'show' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

}
