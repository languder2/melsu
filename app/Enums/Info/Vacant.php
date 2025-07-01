<?php

namespace App\Enums\Info;

enum Vacant
{
    case vacant;
    case eduCode;
    case eduName;
    case eduProf;
    case eduLevel;
    case eduForm;
    case eduCourse;
    case numberBFVacant;
    case numberBRVacant;
    case numberBMVacant;
    case numberPVacant;

    /* methods */
    public function getName(): string
    {
        return __("info.vacant.{$this->name}");
    }
    public function label(): string
    {
        return __("info.vacant.{$this->name}");
    }
}
