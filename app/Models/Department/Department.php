<?php

namespace App\Models\Department;

use App\Models\Department\Section as DepartmentSection;
use App\Models\Department\Staff as DepartmentStaff;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'chief',
        'chief_post',
        'alias',
        'sort',
        'deleted_at'
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => "required|unique:departments,name,{$id},id,deleted_at,NULL",
            'alias' => "nullable|unique:departments,alias,{$id},id,deleted_at,NULL",
            'chief' => '',
            'chief_post' => '',
            'chief_name' => '',
            'sort' => '',
            'sections' => '',
            'staffs' => '',
            'documents' => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name.required' => 'Укажите название',
            'name.unique' => 'Название уже занято',
        ];
    }

    public function staffs(): HasMany
    {
        return $this->hasMany(DepartmentStaff::class, 'department', 'id')
            ->orderBy('sort');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(DepartmentSection::class, 'department', 'id')
            ->orderBy('sort');
    }

    public function getChiefCardAttribute(): Staff|null
    {
        return Staff::find($this->chief);
    }

    public function getLinkAttribute(): string
    {
        return route('public:department:show', [
            'code' => $this->alias ?? $this->id,
        ]);
    }

}
