<?php

namespace App\Traits;

use App\Models\Common\Tags;
use App\Models\News\News;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait hasTags
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(
            Tags::class,
            'relation',
            'tags_relations',
            'relation_id',
            'tag_id'
        );
    }

    public function getTagNamesAttribute(): Collection
    {
        return $this->tags->pluck('name');
    }
}
