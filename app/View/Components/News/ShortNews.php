<?php

namespace App\View\Components\News;

use App\Models\Events\Events;
use App\Models\News\Category;
use App\Models\News\News;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ShortNews extends Component
{
    public string $test = '55';
    public Collection $news;
    public ?Collection $reports;
    public ?Collection $previews;

    /**
     * Create a new component instance.
     */
    public function __construct($category = null)
    {

        $category = Category::find($category);

        $this->news = $category->news()->public()->published()->limit(4)->get();

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
