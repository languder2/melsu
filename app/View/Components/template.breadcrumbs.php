<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

class template.breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public
    function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public
    function render(): View|Closure|string
    {
        return view('components.template.breadcrumbs');
    }
}
