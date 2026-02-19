<?php

namespace App\View\Components\News;

use App\Models\Division\Division;
use App\Models\Events\Events;
use App\Models\News\News;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class InMainPage extends Component
{
    public int $newsCount = 5;
    public int $eventCount = 6;

    public Collection $news;
    public Collection $events;

    public function __construct(Division $division)
    {

        $this->news = News::where('published_at', '<=', Carbon::now())
            ->where('has_approval', true)
            ->where('is_show',true)
            ->orderBy('is_favorite', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit($this->newsCount)
            ->get();


        $this->events = Events::orderBy('event_datetime', 'asc')
            ->where('event_datetime', '>', Carbon::today())
            ->where('event_datetime', '<=', Carbon::tomorrow())
            ->where('has_approval', true)
            ->where('is_show',true)
            ->limit($this->eventCount)->get();

        if($this->events->count() < $this->eventCount)
            $this->events = $this->events->merge(
                Events::orderBy('event_datetime', 'asc')
                    ->where('event_datetime', '>=', Carbon::tomorrow())
                    ->where('has_approval', true)
                    ->where('is_show',true)
                    ->limit($this->eventCount - $this->events->count())->get()
            );

        if($this->events->count() < $this->eventCount)
            $this->events = Events::orderBy('event_datetime', 'desc')
                ->where('event_datetime', '<', Carbon::today())
                ->where('has_approval', true)
                ->where('is_show',true)
                ->limit($this->eventCount - $this->events->count())->get()
                ->merge($this->events);
    }

    public function render(): View|Closure|string
    {
        return view('components.news.in-main-page');
    }
}
