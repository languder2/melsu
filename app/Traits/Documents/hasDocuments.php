<?php

namespace App\Traits\Documents;

use App\Enums\Entities;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait hasDocuments
{

    use hasDocumentCategories;

    public function documents():MorphMany
    {
        return $this->morphMany(Document::class, 'relation')
            ->orderBy('sort')
            ->whereNull('parent_id');
    }
    public function publicDocuments(): Collection
    {
        return $this->documents()->public()->get();
    }
    public function trashedDocuments(): Collection
    {
        return $this->documents()->onlyTrashed()->get();
    }

    public function getDocumentsCabinetListAttribute(): string
    {
        return route('documents.cabinet.list',[
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }


}
