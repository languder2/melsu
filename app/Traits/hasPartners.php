<?php

namespace App\Traits;

use App\Enums\Entities;
use App\Models\Partners\Category as PartnerCategory;
use App\Models\Partners\Partner;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait hasPartners
{
    public function partners(){
        return $this->morphMany(Partner::class, 'relation');
    }

    public function publicPartners(): morphMany
    {
        return $this->partners()->where('is_show', true)->orderBy('sort', 'desc');
    }

    public function partnerCategories(){
        return $this->morphMany(PartnerCategory::class, 'relation')->orderBy('sort');
    }

    /* Links */

    public function partnersCabinetList(): string
    {
        return route('partners.cabinet.list',[
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function partnerCategoryAdd(): string
    {
        return route('partner-categories.cabinet.form',[
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function partnerCategoriesCabinetAdd(): string
    {
        return route('partner-categories.cabinet.form',[
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }



}
