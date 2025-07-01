<?php

namespace App\Enums\Info;

enum Budget
{
    case current;
    case finBFVolume;

    case finBRVolume;
    case finBMVolume;
    case finPVolume;

    /* Volumes */

    case volume;
    case finYear;
    case finPost;
    case finRas;

    /**/
    case finPlanDocLink;




    /* methods */
    public function getName(): string
    {
        return __("info.budget.{$this->name}");
    }
}
