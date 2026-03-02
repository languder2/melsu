<?php

namespace App\Traits;

use App\Models\Staff\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait hasPosts
{
    public function posts(): hasMany
    {
        return $this->hasMany(Post::class, 'staff_id')->with('staff')->orderBy('sort');
    }

    public function getPostAttribute(): ?string
    {
        return $this->pivot?->post ?? null;
    }
    public function getFullPostAttribute(): ?string
    {
        return $this->pivot?->fulL_post ?? null;
    }



}
