<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum EducationForm: string
{
    case Full       = "full-time";
    case Hybrid     = "full-part";
    case Part       = "correspondence";

    public function getName(): string
    {
        return match ($this) {
            self::Full         => 'Очная',
            self::Part         => 'Заочная',
            self::Hybrid       => 'Очно-заочная',
        };
    }
    public function getFullName(): string
    {
        return match ($this) {
            self::Full         => 'Очная форма',
            self::Part         => 'Заочная форма',
            self::Hybrid       => 'Очно-заочная форма',
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



