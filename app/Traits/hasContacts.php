<?php

namespace App\Traits;

use App\Enums\ContactType;
use App\Enums\Entities;
use App\Models\Minor\Contact;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Route;

trait
hasContacts
{
    public function contacts(): morphMany
    {
        return $this->morphMany(Contact::class, 'relation')
            ->orderby('sort','desc');
    }
    public function publicContacts(): morphMany
    {
        return $this->contacts()->where('is_show', true);
    }

    public function getContactsCabinetListAttribute():string
    {
        return route('contacts.cabinet.list', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasContactsCabinetList():bool
    {
        return !Route::is('contacts.cabinet.list');
    }
    public function getContactsCabinetAddAttribute():string
    {
        return route('contacts.cabinet.form', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }

    public function contactsByType($type): MorphMany
    {
        return $this->publicContacts()
            ->where('type',$type)
            ->orderBy('sort', 'desc');
    }

    public function phones(): MorphMany
    {
        return $this->contactsByType(ContactType::Phone);
    }
    public function emails(): MorphMany
    {
        return $this->contactsByType(ContactType::Email);
    }
    public function addresses(): MorphMany
    {
        return $this->contactsByType(ContactType::Address);
    }


}
