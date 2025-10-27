<?php

namespace App\Traits;

use App\Models\Services\Content;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait hasContents
{
    public function getContent(?string $type):MorphOne
    {
        return $this->MorphOne(Content::class, 'relation')->where('type', $type);
    }
    public function getContentRecord():Content
    {
        return $this->getContent('content')->first()
            ?? (new Content(['type' => 'content']))->relation()->associate($this);
    }
    public function getContentAttribute():?string
    {
        return $this->getContentRecord()->content;
    }
    public function getShortRecord():Content
    {
        return $this->getContent('short')->first()
            ?? (new Content(['type' => 'short']))->relation()->associate($this);
    }
    public function getShortAttribute(): ?string
    {
        return $this->getShortRecord()->content;
    }
    public function getFullRecord():Content
    {
        return $this->getContent('full')->first()
            ?? (new Content(['type' => 'full']))->relation()->associate($this);
    }
    public function getFullAttribute(): ?string
    {
        return $this->getFullRecord()->content;
    }
}
