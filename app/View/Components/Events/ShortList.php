<?php

namespace App\View\Components\Events;

use App\Models\News\Events;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ShortList extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $list;

    public function __construct()
    {
        $this->list = Events::where('published_at','<=',Carbon::now())->orderBy('published_at', 'desc')->limit(12)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('news.events.public.short-list');
    }
}
