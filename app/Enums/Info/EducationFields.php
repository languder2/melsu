<?php

namespace App\Enums\Info;

enum EducationFields: string
{
    case eduAccred                      = 'eduAccred';
    case eduCode                        = 'eduCode';
    case eduName                        = 'eduName';
    case eduProf                        = 'eduProf';
    case eduLevel                       = 'eduLevel';
    case eduForm                        = 'eduForm';
    case learningTerm                   = 'learningTerm';
    case eduPred                        = 'eduPred';
    case eduPrac                        = 'eduPrac';
    case languageEl                     = 'languageEl';
    case eduChislenEl                   = 'eduChislenEl';
    case eduPriemEl                     = 'eduPriemEl';
    case eduPerevodEl                   = 'eduPerevodEl';
    case eduOp                          = 'eduOp';
    case opMain                         = 'opMain';
    case educationPlan                  = 'educationPlan';
    case educationRpd                   = 'educationRpd';
    case educationShedule               = 'educationShedule';
    case eduPr                          = 'eduPr';
    case methodology                    = 'methodology';
    case eduAdOp                        = 'eduAdOp';
    case eduNir                         = 'eduNir';
    case perechenNir                    = 'perechenNir';
    case napravNir                      = 'napravNir';
    case resultNir                      = 'resultNir';
    case baseNir                        = 'baseNir';
    case graduateJob                    = 'graduateJob';
    case v1                             = 'v1';
    case t1                             = 't1';

    /* methods */
    public function getName(): string
    {
        return __("info.documents.{$this->value}");
    }

}
