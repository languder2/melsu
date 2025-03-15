<?php

namespace App\Enums;

enum CardBG: string
{
    case DarkRed    = 'bg-base-red';
    case Gray       = 'bg-neutral-700';
//    case Red        = 'bg-red-700';
//    case DarkBlue   = 'bg-blue-950';
//    case DarkGreen  = 'bg-green-950';

    public static function getRandom()
    {
        return collect(self::cases())->random();
    }
    public function getSVG():string
    {
        return match($this){
            self::DarkRed       => asset('bgs/lake.svg'),
            self::Gray          => asset('bgs/tractor.svg'),
        };
    }
}
