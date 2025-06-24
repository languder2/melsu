<?php

namespace App\Enums\Info;

enum StructureFields: string
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
    case emailFil                       = 'emailFil';
    case websiteFil                     = 'websiteFil';
    case repInfo                        = 'repInfo';
    case nameRep                        = 'nameRep';
    case fioRep                         = 'fioRep';
    case postRep                        = 'postRep';
    case addressRep                     = 'addressRep';
    case emailRep                       = 'emailRep';
    case websiteRep                     = 'websiteRep';


    /* methods */
    public function getName(): string
    {
        return __("info.structure.{$this->value}");
    }

}
