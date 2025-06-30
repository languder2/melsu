<?php

namespace App\Enums\Info;

enum CateringFields
{
    case meals;
    case health;
    case objName;
    case objAddress;
    case objSq;
    case objCnt;
    case objOvz;
    /* methods */
    public function getName(): string
    {
        return __("info.standards.{$this->name}");
    }

    public static function get($value): ?self
    {
        foreach(self::cases() as $case)
            if($case->name === $value)
                return $case;

        return null;
    }

}
