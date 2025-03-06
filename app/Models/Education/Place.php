<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    protected $table = 'education_places';

    protected $fillable = [
        'id',
        'type',
        'count',
        'show',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'count' => 'integer|nullable',
            'type',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'count' => 'integer|nullable',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
