<?php

namespace App\Models\Staff;

use App\Models\Division\Division;
use App\Models\Services\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{

    use SoftDeletes;

    protected $table = 'staff_posts';

    protected $fillable = [
        'uuid',
        'division_id',
        'staff_id',
        'post',
        'full_post',
        'is_head_of_division',
        'is_teacher',
        'is_show',
        'is_approved',
        'sort',
        'post_weight',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class)->withTrashed();
    }
    public function getStaffAttribute(): Staff
    {
        return $this->staff()->get()->first() ?? new Staff();
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($post) {
            if($post->staff->posts->isEmpty())
                $post->staff->delete();
        });

        static::saving(function ($post) {
            if($post->isDirty('is_head_of_division') || !$post->sort){
                $list = $post->is_head_of_division ? $post->division->leaders() : $post->division->staffs();
                $post->sort = $list->max('sort') + 100;
            }
        });
        static::saved(function ($post) {
            Log::add($post);
        });

        static::restored(function ($post) {
            if($post->staff->trashed())
                $post->staff->restore();
        });
    }
    public function scopeOnApproval($query)
    {
        return $query->where(fn($query) => $query->where('is_show', false)->orWhere('is_approved', false));
    }
    public function scopePublic($query)
    {
        return $query->where(['is_show' => true, 'is_approved' => true]);
    }

    public static function validateRules(): array
    {
        return [
            'uuid'                  => '',
            'staff_id'              => 'required',
            'post'                  => 'required',
            'full_post'             => '',
            'is_head_of_division'   => '',
            'is_teacher'            => '',
            'is_show'               => '',
            'is_approved'           => '',
        ];
    }

    public static function validateMessages(): array
    {
        return [
            'staff_id'  => 'Укажите сотрудника',
            'post'      => 'Укажите должность',
        ];
    }

    public function getFullnameAttribute(): ?string
    {
        return $this->staff->fullname ?? null;
    }
    public function getFullPostAttribute(): ?string
    {
        return $this->getRawOriginal('full_post') ?? $this->post . ($this->division ? " ({$this->division->name})" : "");
    }

    public static function cabinetRouteName(): ?string
    {
        return match(true) {
            Cache::get('postIsRemoved',false)   => 'division.posts.cabinet.removed',
            Cache::get('postOnApproval', false) => 'division.posts.cabinet.on-approval',
            default                                         => 'division.posts.cabinet.list',
        };
    }
}
