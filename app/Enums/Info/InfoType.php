<?php

namespace App\Enums\Info;

enum InfoType
{
    case Common;
    case Founder;
    case Places;
    case Documents;
    case Standards;
    case Managers;


    public function label():string
    {
        return __("info.types.{$this->name}");
    }
}
