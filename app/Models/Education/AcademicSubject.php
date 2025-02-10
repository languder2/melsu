<?php

namespace App\Models\Education;

use Database\Factories\Education\AcademicSubjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSubject extends Model
{
    /** @use HasFactory<AcademicSubjectFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'education_academic_subjects';

    protected $fillable = [
        'id',
        'name',
        'alt_name',
        'show',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alt_name' => '',
            'show' => '',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите название предмета',
        ];
    }

}
