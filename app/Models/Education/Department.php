<?php

namespace App\Models\Education;

use App\Models\Education\Department as EducationDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'education_departments';

    protected $fillable = [
        'id',
        'name',
        'code',
        'faculty_code',
        'department_code',
        'type_code',
        'parent_id',
        'description',
        'order',
        'created_at',
        'deleted_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'code' => "required|unique:education_departments,code,{$id},id,deleted_at,NULL",
            'faculty_code' => '',
            'department_code' => '',
            'type_code' => 'required',
            'description' => '',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
            'faculty.required' => 'Укажите факультет',
            'type.required' => 'Укажите тип подразделения',
        ];
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'code');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DepartmentType::class, 'type_code', 'code');
    }

    public function getOrderAttribute(?int $value): int|null
    {
        return ($value < 10000) ? $value : null;
    }

    public function setOrderAttribute(?int $value): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public function specialities(): HasMany
    {
        return $this->hasMany(Speciality::class, 'department_code', 'code');
    }

    public function getLinkAttribute(): string
    {
        return route('public:education:department',[
            $this->faculty->code ?? $this->faculty->id,
            $this->code ?? $this->id,
        ]);
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'department_code', 'code')
            ->where('type_code','department')
            ->orderBy('order', 'desc')
            ->orderBy('name');
    }

    public function labs(): HasMany
    {
        return $this->hasMany(self::class, 'department_code', 'code')
            ->where('type_code','lab')
            ->orderBy('order', 'desc')
            ->orderBy('name');
    }


}
