<?php

namespace App\Traits;

use App\Models\News\Category as NewsCategory;

trait hasNewsCategories
{
    public function categories()
    {
        return $this->morphedByMany(
            NewsCategory::class,
            'relation',
            'news_relations',
            'news_id',
            'relation_id'
        );
    }
}
