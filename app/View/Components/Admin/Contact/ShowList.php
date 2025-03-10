<?php

namespace App\View\Components\Admin\Contact;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ShowList extends Component
{
    /**
     * Create a new component instance.
     */

    public ?Collection $list;

    public function __construct(Collection|array|null $list = null)
    {

        if(!$list instanceof Collection)
            $list= collect($list ?? []);

        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.contact.show-list');
    }
}
