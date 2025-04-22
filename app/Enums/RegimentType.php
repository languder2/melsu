<?php

namespace App\Enums;

use Illuminate\Support\Collection;
enum RegimentType:string
{
    case Both           = "Both";
    case Immortal       = 'Immortal';
    case Scientific     = 'Scientific';

    public function getName():string
    {
        return match ($this) {
            self::Both          => __('regiment.Immortal and Scientific'),
            self::Immortal      => __('regiment.Immortal'),
            self::Scientific    => __('regiment.Scientific'),
        };
    }
    public function getFullName():string
    {
        return match ($this) {
            self::Both          => __('regiment.Immortal and Scientific Regiment'),
            self::Immortal      => __('regiment.Immortal Regiment'),
            self::Scientific    => __('regiment.Scientific Regiment'),
        };
    }
    public static function pluck():Collection
    {
        $result = collect([]);

        foreach (self::cases() as $case)
            $result->put($case->name,$case->getFullName());

        return $result;

    }
}
