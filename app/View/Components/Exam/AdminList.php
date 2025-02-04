<?php

namespace App\View\Components\Exam;

use App\Models\Education\AcademicSubject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminList extends Component
{
    /**
     * Create a new component instance.
     */
    public ?array $AcademicSubjects;
    public ?string $code;
    public ?string $type;

    public function __construct($code,$type)
    {
        $this->AcademicSubjects = AcademicSubject::where('show',1)
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->pluck('name','id')
            ->toArray();

        $this->code = $code;
        $this->type = $type;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.exam.admin-list');
    }
}
