<?php

namespace App\Enums\Info;

enum Documents
{
    case ustavDocLink;
    case localActStud;
    case localActOrder;
    case localActCollec;
    case reportEduDocLink;
    case prescriptionDocLink;
    case priemDocLink;
    case modeDocLink;
    case tekKontrolDocLink;
    case perevodDocLink;
    case vozDocLink;

    /* methods */
    public function getName(): string
    {
        return __("info.documents.{$this->name}");
    }

}
