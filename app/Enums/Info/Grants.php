<?php

namespace App\Enums\Info;

enum Grants
{
    /* cabinets */
    case localAct;

    case grant;
    case support;



    /* methods */
    public function getName(): string
    {
        return __("info.grants.{$this->name}");
    }
}
