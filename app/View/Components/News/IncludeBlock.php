<?php

namespace App\View\Components\News;

use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class IncludeBlock extends Component
{
    public int $newsCount = 5;
    public int $onlyNewsCount = 10;
    public int $eventCount = 6;

    public Collection $news;
    public Collection $events;

    public function __construct(Division $division)
    {
        $this->events   = $division->getFlattenTree()->flatMap(fn($item) => $item->publicEvents)
            ->sortByDesc('event_datetime')->take($this->eventCount);

        $this->news     = $division->getFlattenTree()->flatMap(fn($item) => $item->publicNews)
            ->sortByDesc('published_at')->take($this->events->isEmpty() ? $this->onlyNewsCount : $this->newsCount);
    }

    public function render(): View|Closure|string
    {
        return view('components.news.include-block');
    }
}
