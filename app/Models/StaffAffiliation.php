<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class StaffAffiliation extends Model
{
    use SoftDeletes;

    protected $table = 'staff_affiliation';

    protected $fillable = [
        'id',
        'staff_id',
        'alt_name',
        'post',
        'show',
        'order',
        'relation_id',
        'relation_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function FormRules($id):array
    {
        return [
            'staff_id'          => 'nullable|int',
            'alt_name'          => '',
            'post'              => '',
            'show'              => 'boolean',
            'order'             => 'nullable|numeric',
        ];
    }

    public static function FormMessage():array
    {
        return [
            'name'              => 'Укажите текст ссылки',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

}
