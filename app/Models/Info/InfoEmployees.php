<?php

namespace App\Models\Info;

use App\Enums\Info\Objects;
use App\Enums\Info\Employees;
use App\Enums\Info\Types;
use App\Models\Global\Options;
use Illuminate\Support\Collection;

class InfoEmployees extends Info
{

    protected const Types Type = Types::Employees;

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
            'list'              => Options::where('code','is_teacher')->get()->map(fn($item) => $item->relation)
        ];
    }

}
