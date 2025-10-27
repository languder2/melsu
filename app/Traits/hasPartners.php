<?php

namespace App\Traits;

use App\Models\Partners\Partner;

trait hasPartners
{
    public function partners(){
        return $this->morphMany(Partner::class, 'relation');
    }

    public function getAdminPartnersAttribute(): string
    {
        return route('partners.relation.list', [$this->getTable(), $this->id]);
    }
    public function getAddPartnerAttribute(): string
    {
        return route('partners.relation.form', [$this->getTable(), $this->id]);
    }
    public function getSavePartnerAttribute(): string
    {
        return route('partners.relation.save', [$this->getTable(), $this->id]);
    }

}
