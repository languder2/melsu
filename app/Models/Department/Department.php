<?php

namespace App\Models\Department;

use App\Models\Department\Section as DepartmentSection;
use App\Models\Department\Staff as DepartmentStaff;
use App\Models\Staff\Staff;
use App\Models\Staff\Affiliation as StaffAffiliation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Page\Content as PageContent;
use App\Models\Global\Options;
class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'group_id',
        'parent_id',
        'code',
        'order',
    ];

    protected $visible = [
        'id',
        'name',
        'code',
        'group_id',
        'parent_id',
    ];

    public static function FormRules($id): array
    {
        return [
            'name'          => "required|unique:departments,name,{$id},id,deleted_at,NULL",
            'code'          => "nullable|unique:departments,code,{$id},id,deleted_at,NULL",
            'chief'         => '',
            'order'         => '',
            'sections'      => '',
            'staffs'        => '',
            'documents'     => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name.required' => 'Укажите название',
            'name.unique' => 'Название уже занято',
        ];
    }

    public function options(): MorphMany
    {
        return $this->morphMany(Options::class, 'relation');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id','id');
    }

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Coordinator_id','id');
    }

    public function chief(): MorphOne
    {
        return $this->MorphOne(StaffAffiliation::class, 'relation')->where('type','chief');
    }

    public function staffs(): MorphMany
    {
        return $this->morphMany(StaffAffiliation::class, 'relation');
    }

    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation');
    }

    public function getLinkAttribute(): string
    {
        return route('public:department:show', [
            'code' => $this->alias ?? $this->id,
        ]);
    }


}
