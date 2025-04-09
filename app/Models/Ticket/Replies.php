<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Replies extends Model
{
    protected $table = 'ticket_replies';

    protected $fillable = [
        'ticket_id',
        'parent_id',
        'user_id',
        'content',
        'is_new',
        'is_favorite',
        'is_important',
    ];

    protected $casts = [
      'is_new'          => 'boolean',
      'is_favorite'     => 'boolean',
      'is_important'    => 'boolean',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }
    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }
}
