<?php

namespace App\Models\Education;

use Database\Factories\Education\ExamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    /** @use HasFactory<ExamFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'education_exams';

    protected $fillable = [
        'id',
        'subject_id',
        'score',
        'type',
        'required',
        'selectable',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'subject_id' => 'required',
            'score' => 'integer|nullable',
            'type',
            'required' => 'boolean',
            'selectable' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'subject_id' => 'Укажите учебный предмет',
            'score' => 'integer|nullable',
            'required' => 'boolean',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(AcademicSubject::class, 'subject_id', 'id');
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

}
