<?php

namespace App\Enums\Info;

enum InterFields
{
    case internationalDog;
    case stateName;
    case orgName;
    case dogReg;
    public function getName(): string
    {
        return __("info.inter.{$this->name}");
    }

    public static function get($value): ?self
    {
        foreach(self::cases() as $case)
            if($case->name === $value)
                return $case;

        return null;
    }

}
