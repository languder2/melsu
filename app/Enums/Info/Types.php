<?php

namespace App\Enums\Info;

enum Types
{
    case Common;
    case Founder;
    case Places;
    case Education;
    case Documents;
    case Standards;
    case Managers;
    case Objects;
    case Grants;
    case Paid;
    case Budget;
    case Vacant;
    case Inter;
    case Employees;
    case Catering;


    public function label():string
    {
        return __("info.types.{$this->name}");
    }
}
