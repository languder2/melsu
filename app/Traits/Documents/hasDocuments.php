<?php

namespace App\Traits\Documents;

use App\Enums\Entities;
use App\Models\Documents\Document;
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
        return $this->documents()->where('is_show',true)->get();
    }
    public function trashedDocuments(): Collection
    {
        return $this->documents()->onlyTrashed()->get();
    }

    public function getDocumentsCabinetListAttribute(): string
    {
        return route('document-categories.cabinet.list',[
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }


}
