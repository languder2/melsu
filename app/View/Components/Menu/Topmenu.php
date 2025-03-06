<?php

namespace App\View\Components\Menu;

use App\Models\Menu\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topmenu extends Component
{
    /**
     * Create a new component instance.
     */

    public $menu;

    public function __construct()
    {
        $this->menu = Menu::where('code', 'topmenu')
            ->with([
                'items' => function ($q) {
                    $q->orderBy('sort', 'asc')->get();
                }
            ])
            ->first()->items ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.topmenu');
    }
}
