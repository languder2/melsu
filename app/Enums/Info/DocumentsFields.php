<?php

namespace App\Enums\Info;

enum DocumentsFields: string
{
    case ustavDocLink                   = 'ustavDocLink';
    case localActStud                   = 'localActStud';
    case localActOrder                  = 'localActOrder';
    case localActCollec                 = 'localActCollec';
    case reportEduDocLink               = 'reportEduDocLink';
    case prescriptionDocLink            = 'prescriptionDocLink';
    case priemDocLink                   = 'priemDocLink';
    case modeDocLink                    = 'modeDocLink';
    case tekKontrolDocLink              = 'tekKontrolDocLink';
    case perevodDocLink                 = 'perevodDocLink';
    case vozDocLink                     = 'vozDocLink';

    /* methods */
    public function getName(): string
    {
        return __("info.documents.{$this->name}");
    }

}
