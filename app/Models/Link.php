<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    protected $table = 'links';

    protected $fillable = [
        'id',
        'name',
        'title',
        'link',
        'target',
        'show',
        'order',
        'relation_id',
        'relation_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'title' => '',
            'link' => '',
            'target' => '',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите текст ссылки',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
