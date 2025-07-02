<?php

namespace App\Enums\Info;

enum Employees
{
    case teachingStaff;
    case fio;
    case post;
    case teachingDiscipline;
    case teachingLevel;
    case degree;
    case academStat;
    case qualification;
    case profDevelopment;
    case specExperience;
    case teachingOp;

    /* methods */
    public function getName(): string
    {
        return __("info.employees.{$this->name}");
    }
    public function label(): string
    {
        return __("info.employees.{$this->name}");
    }
}
