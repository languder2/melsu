<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class DocumentCategory extends Model
{
    use SoftDeletes;

    protected $table        = 'document_categories';

    protected $fillable     = [
        'name',
        'is_show',
        'sort'
    ];

    protected $casts        = [
        'is_show'           => 'boolean',
        'sort'              => 'integer',
    ];

    public static function FormRules(): array
    {
        return [
//            'test'              => "required",
            'name'              => "required",
            'sort'              => '',
            'is_show'           => '',
        ];
    }
    public static function FormMessage(): array
    {
        return [
            'name'              => 'Укажите названию категории',
        ];
    }
    public function documents():HasMany
    {
        return $this->hasMany(Document::class, 'category_id','id');
    }
    public function publicDocuments():HasMany
    {
        return $this->documents()->where('is_show',true)
            ->whereNull('relation_id')->whereNull('parent_id')->orderBy('sort');
    }

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = array_key_exists('is_show', $attributes);
            $attributes['sort']         = $attributes['sort'] ?? 1000;
        }

        return parent::fill($attributes);
    }

    public function customDocuments():HasMany
    {
        return $this->hasMany(Document::class, 'category_id','id')
            ->whereNull('relation_id')->whereNull('parent_id');
    }

    public static function getPublic():Collection
    {
        return self::where('is_show',true)->orderBy('sort')->orderBy('name')->get();
    }
}
