<?php

namespace App\Enums\Info;

enum Education
{
    case eduAccred;
    case eduCode;
    case eduName;
    case eduProf;
    case eduLevel;
    case eduForm;
    case learningTerm;
    case eduPred;
    case eduPrac;

    /**/
    case languageEl;
    case eduChislenEl;
    case eduPriemEl;
    case eduPerevodEl;

    /**/
    case eduOp;
    case opMain;
    case educationPlan;
    case educationRpd;
    case educationShedule;
    case eduPr;
    case methodology;
    case eduAdOp;
    case eduNir;
    case perechenNir;
    case napravNir;
    case resultNir;
    case baseNir;

    /**/
    case graduateJob;
    case v1;
    case t1;

    /* methods */
    public function getName(): string
    {
        return __("info.education.{$this->name}");
    }
}
