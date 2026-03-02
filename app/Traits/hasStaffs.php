<?php

namespace App\Traits;

use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Matrix\Builder;

trait hasStaffs
{
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Coordinator_id','id');
    }
    public function posts(): hasMany
    {
        return $this->hasMany(Post::class, 'division_id')->with('staff')->orderBy('sort');
    }

    public function staffs(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_posts', 'division_id', 'staff_id')
            ->withPivot('post', 'full_post', 'sort')
            ->orderByPivot('sort');
    }

    public function leader(bool $forPublic = true): ?Staff
    {
        $builder = $this->belongsToMany(Staff::class, 'staff_posts', 'division_id', 'staff_id')
            ->wherePivot('is_head_of_division', 1)
            ->withPivot('post', 'full_post', 'sort', 'is_head_of_division','is_show', 'is_approved');

        if($forPublic)
            $builder->wherePivot('is_show', true)->wherePivot('is_approved', true);

        return $builder->get()->first() ?? new Staff(['is_head_of_division' => 1, 'division_id' => $this->id]);
    }

    public function getLeaderAttribute(): Staff
    {
        return $this->leader();
    }

    public function publicStaffs(): HasMany
    {
        return $this->hasMany(Post::class, 'division_id')->orderBy('sort');
    }

}
