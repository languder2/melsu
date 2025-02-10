<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'id',
        'title',
        'filename',
        'filetype',
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
            'title' => 'required',
            'filename' => "nullable|unique:documents,filename,{$id},id,deleted_at,NULL",
            'filetype' => '',
            'show' => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите имя файла',
            'filename.unique' => 'Alias должен быть указан',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

}
