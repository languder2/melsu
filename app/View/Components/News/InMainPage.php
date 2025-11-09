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

        $this->news = News::where('published_at', '<=', Carbon::now())->where('has_approval', true)->where('is_show',true)
                ->orderBy('published_at', 'desc')->limit($this->newsCount)->get();

        $this->events = Events::orderBy('event_datetime', 'desc')->limit($this->eventCount)->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.news.in-main-page');
    }
}
