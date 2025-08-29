<?php

namespace App\Traits\Documents;

use App\Models\Documents\DocumentCategory;
use App\Traits\GenerateLinks;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasDocumentCategories
{
    use GenerateLinks;

    protected static function bootHasDocumentCategories():void
    {
        static::retrieved(function ($model) {
            $model->generate(
                [
                    'documentCategoriesAdd'     => 'relation:document:categories:admin:form',
                    'documentsAdmin'            => 'relation:documents:admin',
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
