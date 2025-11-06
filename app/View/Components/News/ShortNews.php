<?php

namespace App\View\Components\News;

use App\Models\News\Events;
use App\Models\News\News;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ShortNews extends Component
{
    public string $test = '55';
    public LengthAwarePaginator $news;
    public ?Collection $reports;
    public ?Collection $previews;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->news = News::limit(4)->paginate(1);

        $this->reports = Events::limit(4)->get();

        $this->previews = Events::limit(4)->get();;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news.short-news', [
            'news' => $this->news,
            'previews' => $this->previews,
            'reports' => $this->reports,
        ]);
    }
}
