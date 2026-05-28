<?php

namespace App\Enums\Staff;

enum EducationType
{
    case Education;
    case Retraining;
    public function label(){
        return __("enums.staff.education.{$this->name}");
    }
}
