<?php

namespace App\Traits\Documents;

use App\Models\Documents\DocumentCategory;
use App\Traits\GenerateLinks;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait hasDocumentCategories
{
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
