<?php

namespace App\Enums\Info;

enum Types
{
    case common;
    case founder;
    case places;
    case education;
    case documents;
    case standards;
    case managers;
    case objects;
    case grants;
    case paid;
    case budget;
    case vacant;
    case inter;
    case employees;
    case catering;
    case records;


    public function label():string
    {
        return __("info.types.{$this->name}");
    }
}
