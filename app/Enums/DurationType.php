<?php

namespace App\Enums;

enum DurationType: string
{
    case OOO = 'OOO';
    case SOO = 'SOO';

    public function getComment():string
    {
        return match ($this) {
            self::OOO       => 'Образование. Поступление после 11 классов',
            self::SOO       => 'Образование. Поступление после 9 классов',
        };
    }
}
