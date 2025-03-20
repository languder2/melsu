<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum EducationBasis: string
{
    case Budget     = 'budget';
    case Contract   = 'contract';

    public function getName()
    {
        return match ($this) {
            self::Budget      => __('education-types.Budget'),
            self::Contract    => __('education-types.Contract'),
        };
    }

    public static function getList(): Collection
    {
        $result =  collect([]);
        foreach (self::cases() as $case)
            $result->put($case->value, $case->getName());

        return  $result;
    }

}
