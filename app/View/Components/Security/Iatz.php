<?php

namespace App\View\Components\Security;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Iatz extends Component
{
    /**
     * Create a new component instance.
     */

    public Collection $list;
    public function __construct()
    {
        $allFiles = Storage::allFiles('images/iatz');

        $imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp'];

        $this->list = collect($allFiles)->filter(function ($file) use ($imageExtensions) {
            return Str::endsWith(strtolower($file), $imageExtensions);
        })->map(fn ($file) => Storage::url($file));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.security.iatz');
    }
}
