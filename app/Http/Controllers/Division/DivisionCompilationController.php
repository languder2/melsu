<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

class DivisionCompilationController extends Controller
{
    public Collection $facultiesAndBranches;
    public function __construct()
    {
        $this->facultiesAndBranches = collect([
            'institutes' => [
                'name'  => __('divisions.type.Institutes'),
                'href'  => route('public:education:institutes')
            ],
            'faculties' => [
                'name'  => __('divisions.type.Faculties'),
                'href'  => route('public:education:faculties')
            ],
            'departments' => [
                'name'  => __('divisions.type.Departments'),
                'href'  => route('public:education:departments:list')
            ],
            'science-labs' => [
                'name'  => __('divisions.type.Science labs'),
                'href'  => route('public.science-labs.list')
            ],
            'education-labs' => [
                'name'  => __('divisions.type.Education labs'),
                'href'  => route('public.education-labs.list')
            ],
            'branches' => [
                'name'  => __('divisions.type.Branches'),
                'href'  => route('public:education:branch:list')
            ],
        ]);
    }
    public function scienceLabs(): View
    {
        $list = Division::where('type',DivisionType::Lab)
            ->where('is_show',1)
            ->where('is_approved',1)
            ->orderBy('sort')
            ->orderBy('name')
            ->get();

        return view('divisions.public.compilations.education-by-type',[
            'active'    => 'science-labs',
            'tabs'      => $this->facultiesAndBranches,
            'list'      => $list,
            'type'      => 'type-1'
        ]);
    }

    public function educationLabs(): View
    {
        $list = Division::where('type',DivisionType::EducationLab)
            ->where('is_show',1)
            ->where('is_approved',1)
            ->orderBy('sort')
            ->orderBy('name')
            ->get();

        return view('divisions.public.compilations.education-by-type',[
            'active'    => 'education-labs',
            'tabs'      => $this->facultiesAndBranches,
            'list'      => $list,
            'type'      => 'type-1'
        ]);
    }

    public function educationalInfrastructure(): View
    {
        Breadcrumbs::for('educational-infrastructure', function (BreadcrumbTrail $trail) {
            $trail->parent('home');
            $trail->push(__('headers.educational-infrastructure'), url('educational-infrastructure'));
        });


        $list = Division::where('type',DivisionType::EducationLab)
            ->where('is_show',1)
            ->where('is_approved',1)
            ->orderBy('sort')
            ->orderBy('name')
            ->get();

        return view('divisions.public.compilations.educational-infrastructure', compact('list'));
    }
}
