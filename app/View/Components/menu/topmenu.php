<?php

namespace App\View\Components\menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class topmenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu   = Menu::where('code','topmenu')
            ->with([
                'items' => function ($q) {
                    $q->orderBy('sort', 'asc')->get();
                }
            ])
            ->first();

        return view('components.menu.topmenu',[
            'menu' => $menu->items??[],
        ]);
    }
}
