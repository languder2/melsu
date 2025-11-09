<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\News\News;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait hasNews
{
    public function news(): MorphToMany
    {
        return $this->morphToMany(
            News::class,
            'relation',
            'news_relations',
            'relation_id',
            'news_id'
        );
    }

    public function allNews(): Collection
    {
        return $this->getFlattenTree()->flatMap(fn($item) => $item->news)->unique('id')->sortByDesc('event_datetime');
    }

    public function publicNews(): Collection
    {

        return $this->getFlattenTree()->flatMap(fn($item) => $item->news)->unique('id')
            ->filter(fn($item) => $item->published_at <= Carbon::now() && $item->is_show && $item->has_approval)
            ->sortByDesc('published_at');

//        return $this->news()
//            ->where('published_at','<=', Carbon::now())
//            ->where('is_show',1)
//            ->where('has_approval',true)
//            ->orderBy('is_favorite', 'desc')
//            ->orderBy('sort', 'asc')
//            ->orderBy('published_at', 'desc')
//            ->get()
//            ;
    }
    public function NewsLink(?string $op): string
    {
        return match($this->type){
            default => route('news.relation.show',$op),
            DivisionType::Institute, DivisionType::Faculty, DivisionType::Department, DivisionType::Branch
            => route('public:education:division', [$this->type->value,$this->code ?? $this->id,'news',$op]),
        };
    }

    public function allPublicEvents(): Collection
    {
        return $this->getFlattenTree()->flatMap(fn($item) => $item->events)->unique('id')->sortByDesc('event_datetime');
    }
}
