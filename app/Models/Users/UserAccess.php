<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccess extends Model
{
    use SoftDeletes;

    protected $table = 'user_access';

    protected $fillable = [
        'user_id',
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
