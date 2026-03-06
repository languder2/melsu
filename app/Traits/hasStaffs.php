<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait hasStaffs
{
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Coordinator_id','id');
    }
    public function allStaff(): hasMany
    {
        return $this->hasMany(Post::class, 'division_id')
            ->with('staff')
            ->orderBy('is_head_of_division', 'desc')
            ->orderBy('sort')
        ;
    }
    public function allPublicStaff(): hasMany
    {
        return $this->allStaff()->public();
    }
    public function allPublicStaffCount(): int
    {
        return $this->allPublicStaff()->count();
    }
    public function allOnApprovalStaffCount(): int
    {
        return $this->allStaff()->onApproval()->get()->count();
    }
    public function allTrashedStaffCount(): int
    {
        return $this->allStaff()->onlyTrashed()->get()->count();
    }
    public function leaders(): hasMany
    {
        return $this->allStaff()->where('is_head_of_division', true);
    }
    public function publicLeaders(): hasMany
    {
        return $this->leaders()
            ->public()
        ;
    }
    public function onApprovalLeaders(): hasMany
    {
        return $this->leaders()
            ->onApproval()
        ;
    }
    public function trashedLeaders(): hasMany
    {
        return $this->leaders()
            ->onlyTrashed()
        ;
    }
    public function staffs(): hasMany
    {
        return $this->allStaff()->where('is_head_of_division', false);
    }
    public function publicStaffs(): hasMany
    {
        return $this->staffs()
            ->public()
        ;
    }
    public function onApprovalStaffs(): hasMany
    {
        return $this->staffs()
            ->onApproval()
        ;
    }

    public function trashedStaffs(): hasMany
    {
        return $this->staffs()
            ->onlyTrashed()
        ;
    }

    public function getLeaderAttribute(): Post
    {
        return $this->leaders->first() ?? new Post();
    }

    public function teachers(): hasMany
    {
        return $this->allStaff()->where('is_teacher', true);
    }

    public function publicTeachers(): hasMany
    {
        return $this->teachers()->public();
    }

    public function allPublicTeachers(): Collection
    {
        if($this->type === DivisionType::Department)
            $list = $this->publicTeachers->unique('staff_id');

        elseif($this->type === DivisionType::Faculty)
            $list = $this->subs()->where('type', DivisionType::Department)->get()
                ->flatmap(fn($item) => $item->publicTeachers)->unique('staff_id');

        return $list->sortBy('full_name');
    }



}
