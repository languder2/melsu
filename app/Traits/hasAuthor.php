<?php

namespace App\Traits;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait hasAuthor
{
    public function author():BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
