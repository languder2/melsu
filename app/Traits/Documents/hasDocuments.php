<?php

namespace App\Traits\Documents;

use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait hasDocuments
{
    protected static function bootHasDocuments():void
    {
    }
    public function documentCategories(): MorphMany
    {
        return $this->morphMany(DocumentCategory::class, 'relation')->orderBy('sort');
    }
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'relation')->orderBy('sort');
    }

    public function publicDocumentCategories(): MorphMany
    {
        return $this->morphMany(DocumentCategory::class, 'relation')->orderBy('sort');
    }


}
