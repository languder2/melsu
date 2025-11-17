<?php

namespace App\View\Components\Events;

use App\Models\Events\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListByCategory extends Component
{

    public Collection $list;
    public function __construct($category)
    {
        $category = Category::where('code', $category)->first();

        $this->list = $category->events()
            ->where('is_show', true)
            ->where('has_approval', true)
            ->latest('event_datetime')
            ->get();
    }
    public function render(): View|Closure|string
    {
        return view('components.events.list-by-category');
    }
}
