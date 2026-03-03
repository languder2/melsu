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

    public function allStaff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_posts', 'division_id', 'staff_id')
            ->withPivot('post', 'full_post', 'sort', 'is_head_of_division', 'is_show', 'is_approved')
            ->orderByPivot('is_head_of_division', 'desc')
            ->orderByPivot('sort');
    }
    public function staffs(): BelongsToMany
    {
        return $this->allStaff()->wherePivot('is_head_of_division', false);
    }

    public function leaders(): BelongsToMany
    {
        return $this->allStaff()->wherePivot('is_head_of_division', true);
    }

    public function getLeaderAttribute(): Staff
    {
        return $this->leaders()->where(['is_show' => true, 'is_approved' => true])->first() ?? new Staff();
    }
    public function publicStaffs(): BelongsToMany
    {
        return $this->staffs()->wherePivot('is_show', true)->wherePivot('is_approved', true);
    }

}
