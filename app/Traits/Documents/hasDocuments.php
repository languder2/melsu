<?php

namespace App\Traits\Documents;

use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;

trait hasDocuments
{
    protected static function bootHasDocuments():void
    {
    }
    public function documentCategories(){
        return $this->morphMany(DocumentCategory::class, 'relation')->orderBy('sort');
    }
    public function documents(){
        return $this->morphMany(Document::class, 'relation')->orderBy('sort');
    }

}
