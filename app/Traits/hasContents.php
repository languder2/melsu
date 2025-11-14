<?php

namespace App\Traits;

use App\Models\Services\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
trait hasContents
{
    protected array $magicGetForContentRecord = [
        'prefix'    => '_record',
        'fn'        => 'get_content_record',
    ];
    public function get_content_record($key): Content
    {
        $type = str_replace('_record', '', $key);

        return $this->getContent($type)->firstOrNew()->fill(['type' => $type]);
    }
    protected array $magicGetForContentHtml = [
        'prefix'    => '_html',
        'fn'        => 'get_content_html',
    ];
    public function get_content_html($key): ?string
    {
        $type = str_replace('_html', '', $key);

        return $this->getContent($type)->firstOrNew()->render();
    }
    protected array $magicGetForContentText = [
        'prefix'    => '_text',
        'fn'        => 'get_content_text',
    ];
    public function get_content_text($key): ?string
    {
        $type = str_replace('_text', '', $key);

        return $this->getContent($type)->firstOrNew()->content;
    }

    public function contents(): MorphMany
    {
        return $this->morphMany(Content::class, 'relation');
    }

    public function getContent(?string $type):MorphOne
    {
        return $this->MorphOne(Content::class, 'relation')->where('type', $type);
    }

    public function content(?string $type): Content
    {
        return $this->MorphOne(Content::class, 'relation')
            ->where('type', $type)
            ->first()
            ?? (new Content(['type' => 'content']))->relation()->associate($this);
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

    public function getContentHTMLAttribute()
    {
        return $this->getContentRecord()->render();
    }

    public function getHistoryAttribute():Content
    {
        return $this->getContent('history')->first()
            ?? (new Content(['type' => 'history']))->relation()->associate($this);
    }

    public function getHistoryHtmlAttribute(): ?string
    {
        return $this->historyRecord()->render();
    }



}
