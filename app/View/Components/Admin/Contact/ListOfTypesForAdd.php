<?php

namespace App\View\Components\Admin\Contact;

use App\Enums\ContactType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListOfTypesForAdd extends Component
{
    public array $types;
    public function __construct()
    {
        $this->types = ContactType::cases();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.contact.list-of-types-for-add');
    }
}
