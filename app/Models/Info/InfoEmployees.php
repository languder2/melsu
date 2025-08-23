<?php

namespace App\Models\Info;

use App\Enums\Info\Objects;
use App\Enums\Info\Employees;
use App\Enums\Info\Types;
use App\Models\Employees\Employee;
use App\Models\Global\Options;
use Illuminate\Support\Collection;

class InfoEmployees extends Info
{
    protected const Types Type = Types::employees;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Employees::cases());

        parent::__construct($arguments);
    }

    protected const array Fields = [
        Employees::fio,
        Employees::post,
        Employees::teachingDiscipline,
        Employees::teachingLevel,
        Employees::degree,
        Employees::academStat,
        Employees::qualification,
        Employees::profDevelopment,
        Employees::specExperience,
        Employees::teachingOp,
    ];

    public function template() : array
    {
        return [
            'label'             => Employees::teachingStaff->label(),
            'prop'              => Employees::teachingStaff->name,
            'captions'          => self::Fields,
            'list'              =>
                Employee::all()->mapWithKeys(function ($item) {


                    $item->fio  = $item->staff->full_name;
                    $item->post = $item->staff->AffiliationPosts()->implode('; ');
                    return [$item->staff->full_name => $item];
                })->sortBy('fio')
        ];
    }

}

//Employee::orderBy('fio')->orderBy('post')->get()->groupBy('fio')
//    ->map(function ($group) {
//        $item = $group->first();
//
//        if($group->count() > 1)
//            $item->post = implode(',<br>', $group->map(
//                fn($item) => mb_ucfirst(trim($item->post))
//            )->toArray());
//        else
//            $item->post = mb_ucfirst(trim($item->post));
//
//        return $item;
//    })
