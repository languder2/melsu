<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\Division\Division;
use App\Models\News\News;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function publicNews($withTree = true ): Collection
    {
        $IDs = [$this->id];

        if($this instanceof Division && $withTree)
            $IDs   = $this->tree()->pluck('id');

        $newsIDs = DB::table('news_relations')
            ->whereIn('relation_id', $IDs)
            ->where('relation_type', $this::class)
            ->get()
            ->pluck('news_id')->unique();

        return News::whereIn('id', $newsIDs)
            ->where('published_at','<=', Carbon::now())
            ->where('is_show',1)
            ->where('has_approval',true)
            ->orderBy('is_favorite', 'desc')
            ->orderBy('sort', 'asc')
            ->orderBy('published_at', 'desc')
            ->get();
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
