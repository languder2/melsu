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
use Illuminate\Support\Facades\Cache;

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
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->documents()->delete();
            $item->subs()->delete();
        });

        static::saving(function ($item) {
            if(!$item->exists || (int)$item->sort < 0){

                if($item->relation)
                    $item->sort = $item->relation->documentCategories()->max('sort') + 100;
                else
                    $item->sort = DocumentCategory::where('parent_id', $item->parent_id)
                            ->whereNull('relation_id')->max('sort') + 100;

                $item->sort = round($item->sort, -2);
            }
        });

        static::saved(fn($item) => Cache::forever(
            "documents-category-{$item->id}",
            view('documents.public.category', ['category' => $item])->render()
        ));

    }

    public function scopePublic(Builder $query): void
    {
        $query->where('is_show', true);
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
        return $this->hasMany(Document::class, 'category_id', 'id');
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
    public function allPublicDocuments(): Collection
    {
        return $this->allDocuments()
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
