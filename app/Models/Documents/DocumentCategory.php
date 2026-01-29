<?php

namespace App\Models\Documents;

use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class DocumentCategory extends Model
{
    use SoftDeletes, hasRelations;

    protected $table = 'document_categories';
    protected string $entity = 'document-categories';


    protected $fillable = [
        'name',
        'parent_id',
        'is_show',
        'sort',
    ];

    protected $casts = [
        'is_show' => 'boolean',
        'sort' => 'integer',
    ];

    public static function validateRules(): array
    {
        return [
            'name'          => "required",
            'parent_id'     => '',
            'sort'          => '',
            'is_show'       => '',
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
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->documents()->delete();
            $item->subs()->delete();
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id', 'id');
    }

    public function publicDocuments(): Collection
    {
        return $this->documents()->where('is_show', true)
            ->whereNull('relation_id')->whereNull('parent_id')->orderBy('sort')
            ->get();
    }

    public function getDocuments(): Collection
    {
        return $this->documents()
            ->where('is_show', true)
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();
    }


    public function fill(array $attributes): ?self
    {
        if (!empty($attributes)) {
            $attributes['is_show'] = array_key_exists('is_show', $attributes);
            $attributes['sort'] = $attributes['sort'] ?? 1000;
        }

        return parent::fill($attributes);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function customDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id', 'id')
            ->whereNull('relation_id')->whereNull('parent_id');
    }

    public static function getPublic(): Collection
    {
        return self::where('is_show', true)->whereNull('relation_id')->orderBy('sort')->orderBy('name')->get();
    }
    public function getSaveAttribute():string
    {
        return route('document-categories:save', $this);
    }
    public function getRelationDocumentCategorySaveAttribute():?string
    {
        return route('division:admin:document-categories:save', [$this->relation->id ?? null, $this]);
    }
    public function getNameWithParentsAttribute():?string
    {
        return $this->parent_id ? "{$this->parent->name_with_parents} → {$this->name}" : $this->name;
    }

    public function getRelationDocumentAddAttribute():string
    {
        return route('division:admin:documents:form', [$this->relation->id ?? null, $this]);
    }

    public function getRelationAdminAttribute():?string
    {
        return route('division:admin:documents:list', $this->relation);
    }
    public function getRelationFormAttribute():?string
    {
        return route('division:admin:document-categories:form', [$this->relation->id ?? null, $this]);
    }
    public function getRelationDeleteAttribute():?string
    {
        return route('division:admin:document-categories:delete', $this);
    }


}
