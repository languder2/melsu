<?php

namespace App\Enums\Info;

enum Managers
{
    case rucovodstvo;
    case fio;
    case post;
    case telephone;
    case email;
    case rucovodstvoZam;
    case rucovodstvoFil;
    case nameFil;

    /* methods */
    public function getName(): string
    {
        return __("info.managers.{$this->name}");
    }

    public static function get($value): ?self
    {
        foreach(self::cases() as $case)
            if($case->name === $value)
                return $case;

        return null;
    }

}
