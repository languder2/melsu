<?php

namespace App\View\Components\Info\Education;

use App\Enums\ProfileDocumentType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DocumentForm extends Component
{
    public Collection $types;
    public Collection $years;
    public function __construct()
    {
        $this->types = ProfileDocumentType::list();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.info.education.document-form');
    }
}
