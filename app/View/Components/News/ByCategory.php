<?php

namespace App\View\Components\News;

use App\Models\Division\Division;
use App\Models\News\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ByCategory extends Component
{
    public int $newsCount = 20;

    public Collection $news;

    public function __construct(string|Category $category)
    {
        if(!($category instanceof Category))
            $category = Category::where('code', $category)->first();

        $this->news   = $category->publicNews()->take($this->newsCount);
    }

    public function render(): View|Closure|string
    {
        return view('components.news.by-category');
    }
}
