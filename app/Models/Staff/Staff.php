<?php

namespace App\Models\Staff;

use App\Models\Division\Division;
use App\Models\Employees\Employee;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use App\Models\Services\Log;
use App\Traits\hasImage;
use App\Traits\hasOptions;
use App\Traits\hasPosts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Staff\Post;
use Illuminate\Support\Collection;
use PhpOption\Option;

class Staff extends Model
{
    use SoftDeletes, hasPosts, hasOptions, hasImage;

    protected $table = 'staffs';

    protected $fillable = [
        'id',
        'uuid',
        'photo',
        'lastname',
        'firstname',
        'middle_name',
        'birthday',
        'birthplace',
        'residence',
        'education',
        'retraining',
        'awards',
        'affiliation',
        'family_status',
        'title',
        'titles',
        'reception_time',
        'phones',
        'emails',
        'address',
        'link',
        'alias',
    ];

    public static function validateRules($id): array
    {
        return [
            'lastname' => 'required',
            'firstname' => 'required',
            'middle_name' => '',
            'birthday' => '',
            'birthplace' => '',
            'residence' => '',
            'education' => '',
            'retraining' => '',
            'awards' => '',
            'affiliation' => '',
            'family_status' => '',
            'title' => '',
            'reception_time' => '',
            'phones' => '',
            'emails' => '',
            'address' => '',
            'posts' => '',
            'alias' => "nullable|unique:staffs,alias,{$id},id,deleted_at,NULL",
        ];
    }

    public static function validateMessage(): array
    {
        return [
            'post' => 'Укажите должность',
            'lastname' => 'Укажите фамилию',
            'firstname' => 'Укажите имя',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($staff) {
            $staff->posts()->delete();
            $staff->images()->delete();
        });

        static::saved(function ($staff) {
            Log::add($staff);
        });
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'id','staff_id');
    }

    public function getLinkAttribute(): string
    {
        return url("staffs/" . ($this->alias ?? $this->id));
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->lastname} {$this->firstname} {$this->middle_name}");
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(JobHistory::class,'staff_id', 'id');
    }
    public function sortedJobs(): HasMany
    {
        return $this->jobs()
            ->orderBy('employment_year', 'desc')
            ->orderByRaw('dismissal_year IS NULL DESC')
            ->orderBy('dismissal_year', 'desc')
            ->orderBy('sort');
    }

    public function divisions():HasMany
    {
        return $this->hasMany(Division::class,'coordinator_id', 'id')
            ->orderBy('sort')
            ->orderBy('name');
    }

    public function getFormAttribute(): string
    {
        return route('admin:staff:edit', $this);
    }

}
