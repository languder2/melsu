<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\News\News;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait hasNews
{
    public function news(): MorphMany
    {
        return $this->morphMany(News::class, 'relation')
            ->orderBy('published_at');
    }

    public function newsInRelation(): MorphToMany
    {
        return $this->morphToMany(
            News::class,
            'relation',
            'news_relations',
            'relation_id',  // Ключ этой модели (Division) в таблице attachments
            'news_id'       // Ключ целевой модели (News) в таблице attachments
        );
    }
    public function publicNews(): MorphMany
    {
        return $this->news()
            ->where('published_at','<=', Carbon::now())
            ->where('is_show',1)
            ->where('has_approval',true)
            ->orderBy('is_favorite', 'desc')
            ->orderBy('sort', 'asc')
            ->orderBy('published_at', 'desc')
            ;
    }
    public function NewsLink(?string $op): string
    {
        return match($this->type){
            default => route('news.relation.show',$op),
            DivisionType::Institute, DivisionType::Faculty, DivisionType::Department, DivisionType::Branch
            => route('public:education:division', [$this->type->value,$this->code ?? $this->id,'news',$op]),
        };
    }
}
