<?php

namespace App\View\Components\Exam;

use App\Models\Education\AcademicSubject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AdminList extends Component
{
    /**
     * Create a new component instance.
     */
    public ?array $AcademicSubjects;
    public ?string $code;
    public ?string $type;
    public ?Collection $exams = null;

    public function __construct($code, $type, $exams = null)
    {
        $this->AcademicSubjects = AcademicSubject::where('show', 1)
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();


        $this->code = $code;
        $this->type = $type;
        if ($exams)
            $this->exams = $exams->where('type', $type)->keyBy('subject_id');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.exam.admin-list');
    }
}
