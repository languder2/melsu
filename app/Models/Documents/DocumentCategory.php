<?php

namespace App\Models\Documents;

use App\Traits\hasContents;
use App\Traits\hasOptions;
use App\Traits\hasRelations;
use App\Traits\hasSubordination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class DocumentCategory extends Model
{
    use SoftDeletes, hasRelations, hasOptions, hasSubordination, hasContents;

    protected $table = 'document_categories';
    protected string $entity = 'document-categories';

    protected $fillable = [
        'name',
        'parent_id',
        'is_show',
        'is_approved',
        'sort',
    ];

    protected $casts = [
        'is_show'       => 'boolean',
        'is_approved'   => 'boolean',
        'sort'          => 'integer',
    ];

    public static function validateRules(): array
    {
        return [
            'name'          => "required",
            'parent_id'     => '',
            'sort'          => '',
            'is_show'       => '',
            'is_approved'   => '',
        ];
    }

    public static function validateMessages(): array
    {
        return [
            'name' => 'Укажите названию категории',
        ];
    }
    public static function validationRules(): array
    {
        return [
            'name'          => "required",
            'parent_id'     => '',
            'sort'          => '',
            'is_show'       => '',
            'is_approved'   => '',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'name' => 'Укажите названию категории',
        ];
    }

    /**
     * Scope a query to include only publicly visible document categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePublic(Builder $query): void
    {
        $query->where('is_show', true);
    }
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->documents()->delete();
            $item->subs()->delete();
        });

        static::saving(function ($item) {
            if(!$item->exists || (int)$item->sort < 0)
                $item->sort = $item->relation->documentCategories()->max('sort') + 100;
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id', 'id')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ;
    }

    public function allDocuments(): HasMany
        {
        return $this->documents()->with('subs');
    }

    public function publicDocuments(): Collection
    {
        return $this->documents()
            ->where('is_show', true)
            ->where('is_approved', true)
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public static function publicCustom(): Collection
    {
        return self::whereNull('relation_id')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->orderBy('name')
            ->get();
    }



}
