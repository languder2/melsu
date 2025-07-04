<?php

namespace App\Enums\Info;

enum Founder
{
    case uchredLaw;
    case nameUchred;
    case addressUchred;
    case telUchred;
    case mailUchred;
    case websiteUchred;


    /* methods */
    public function getName(): string
    {
        return __("info.founder.{$this->name}");
    }
    public function label(): string
    {
        return __("info.founder.{$this->name}");
    }
}
