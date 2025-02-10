<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $table = 'department_sections';

    protected $fillable = [
        'id',
        'department',
        'name',
        'show_title',
        'text',
        'sort',
    ];

    public static function FormRules($id): array
    {
        return [];
    }

    public static function FormMessage(): array
    {
        return [];
    }


}
