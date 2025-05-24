<?php

namespace App\Models\Upbringing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Upbringing extends Model
{
    protected $table = 'upbringing_sections';

    protected $fillable = [
        'title', 'show_title', 'code', 'component', 'content',
        'relation_id', 'relation_type', 'show', 'order'
    ];

    protected $casts = [
        'show_title' => 'boolean',
        'show' => 'boolean',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
