<?php

namespace App\Traits;

use App\Models\Division\Division;
use App\Models\News\Events;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Termwind\Components\Div;

trait hasDivisionRelation
{
    public function divisions()
    {
        return $this->morphedByMany(
            Division::class,
            'relation',
            'news_relations',
            'news_id',
            'relation_id'
        );
    }
    public function events()
    {
        return $this->morphedByMany(
            Events::class,
            'relation',
            'news_relations',
            'news_id',
            'relation_id'
        );
    }
}
