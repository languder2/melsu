<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use SoftDeletes;

    protected $table = 'faq';

    protected $fillable = [
        'id',
        'question',
        'answer',
        'show',
        'relation_id',
        'relation_type',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'question' => 'required',
            'answer' => 'required',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'question' => 'Укажите вопрос',
            'answer' => 'Заполните ответ',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
