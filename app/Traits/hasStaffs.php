<?php

namespace App\Traits;

use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->hasMany(Post::class, 'division_id')->with('staff')->orderBy('sort');
    }
    public function allPublicStaffCount(): int
    {
        return $this->allStaff()->public()->get()->count();
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
    public function publicLeaders(): Collection
    {
        return $this->leaders()
            ->public()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }
    public function onApprovalLeaders(): Collection
    {
        return $this->leaders()
            ->onApproval()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }
    public function trashedLeaders(): Collection
    {
        return $this->leaders()
            ->onlyTrashed()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }
    public function staffs(): hasMany
    {
        return $this->allStaff()->where('is_head_of_division', false);
    }
    public function publicStaffs(): Collection
    {
        return $this->staffs()
            ->public()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }
    public function onApprovalStaffs(): Collection
    {
        return $this->staffs()
            ->onApproval()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }

    public function trashedStaffs(): Collection
    {
        return $this->staffs()
            ->onlyTrashed()
            ->get()
            ->sortBy('sort')->sortBy('fullname')
        ;
    }


}
