<?php

namespace App\View\Components\Menu;

use App\Models\{Menu};
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Mainmenu extends Component
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

        $menu = Menu::GetMainMenu();

        return view('components.menu.mainmenu', [
            'list' => $menu->items ?? [],
        ]);
    }
}
