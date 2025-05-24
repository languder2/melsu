<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Partner extends Model
{

    protected $table = 'partner_sections';

    protected $fillable = [
        'title',
        'show_title',
        'code',
        'component',
        'content',
        'relation_id',
        'relation_type',
        'show',
        'order'
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
}
