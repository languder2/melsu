<?php

namespace App\Enums;

enum EducationForm: string
{
    case Full       = "full-time";
    case Hybrid     = "correspondence";
    case Part       = "full-part";

    public function getName(): string
    {
        return match ($this) {
            self::Full         => 'Очная',
            self::Part         => 'Заочная',
            self::Hybrid       => 'Очно-заочная',
        };
    }

}



