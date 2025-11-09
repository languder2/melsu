<?php

namespace App\View\Components\Events;

use App\Models\Events\Events;
use App\Models\News\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListByCategory extends Component
{

    public Collection $list;
    /**
     * Create a new component instance.
     */
    public function __construct($category)
    {
        $category = Category::where('code', $category)->first();

        $this->list = Events::whereNotNull('event_datetime')
            ->where('category_id', $category->id ?? null)
            ->latest('event_datetime')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.list-by-category');
    }
}
