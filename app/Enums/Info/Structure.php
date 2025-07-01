<?php

namespace App\Enums\Info;

enum Structure: string
{
    case structOrgUprav                 = 'structOrgUprav';
    case name                           = 'name';
    case fio                            = 'fio';
    case post                           = 'post';
    case addressStr                     = 'addressStr';
    case site                           = 'site';
    case email                          = 'email';
    case divisionClauseDocLink          = 'divisionClauseDocLink';
    case filInfo                        = 'filInfo';
    case nameFil                        = 'nameFil';
    case fioFil                         = 'fioFil';
    case postFil                        = 'postFil';
    case addressFil                     = 'addressFil';
    case websiteFil                     = 'websiteFil';
    case emailFil                       = 'emailFil';
    case repInfo                        = 'repInfo';
    case nameRep                        = 'nameRep';
    case fioRep                         = 'fioRep';
    case postRep                        = 'postRep';
    case addressRep                     = 'addressRep';
    case websiteRep                     = 'websiteRep';
    case emailRep                       = 'emailRep';


    /* methods */
    public function getName(): string
    {
        return __("info.structure.{$this->value}");
    }

}
