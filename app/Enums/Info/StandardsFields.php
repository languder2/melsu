<?php

namespace App\Enums\Info;

enum StandardsFields
{
    case eduFedDoc;
    case eduStandartDoc;
    case eduFedTreb;
    case eduStandartTreb;

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
