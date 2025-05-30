<?php

namespace App\Enums;

use Illuminate\Support\Collection;
enum RegimentType:string
{
    case Both           = "Both";
    case Immortal       = 'Immortal';
    case Scientific     = 'Scientific';
    case Svo            = 'Svo';

    public function getName():string
    {
        return match ($this) {
            self::Both          => __('regiment.Immortal and Scientific'),
            self::Immortal      => __('regiment.Immortal'),
            self::Scientific    => __('regiment.Scientific'),
            self::Svo           => __('regiment.SVO'),
        };
    }
    public function getFullName():string
    {
        return match ($this) {
            self::Both          => __('regiment.Immortal and Scientific Regiment'),
            self::Immortal      => __('regiment.Immortal Regiment'),
            self::Scientific    => __('regiment.Scientific Regiment'),
            self::Svo           => __('regiment.SVO Full'),
        };
    }
    public static function pluck():Collection
    {
        $result = collect([]);

        foreach (self::cases() as $case)
            $result->put($case->value,$case->getFullName());

        return $result;
    }
    public function ico():string
    {
        return match ($this) {
            self::Immortal      => asset('img/regiments-menu-ico/immortal.svg'),
            self::Scientific    => asset('img/regiments-menu-ico/scientific.svg'),
            self::Svo           => asset('img/regiments-menu-ico/hero.svg'),
        };
    }
}
