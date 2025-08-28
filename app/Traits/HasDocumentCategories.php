<?php

namespace App\Traits;

use App\Models\Documents\DocumentCategory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasDocumentCategories
{
    use GenerateLinks;

    protected static function bootHasDocumentCategories():void
    {
        static::retrieved(function ($model) {
            $model->generate(
                'documentCategories',
                [
                    'categoryAdd'   => 'relation:document:categories:admin:form',
                ],
                [$model->getTable(), $model->id]
            );
        });
    }

    public function documentCategories():MorphMany
    {
        return $this->morphMany(DocumentCategory::class, 'relation')
            ->whereNull('parent_id')
            ;
    }
    public function publicDocumentCategories(): Collection
    {
        return $this->documentCategories()->public()->get();
    }
    public function trashedDocumentCategories(): Collection
    {
        return $this->documentCategories()->onlyTrashed()->get();
    }

}
