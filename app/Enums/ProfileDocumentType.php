<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ProfileDocumentType
{
    case curriculum;
    case workPrograms;
    case trainingSchedule;
    case practicePrograms;
    case other;

    public function label(): string
    {
        return __("documents.profile.type.{$this->name}");
    }
    public static function list(): Collection
    {
        $result =  collect([]);
        foreach (self::cases() as $case)
            $result->put($case->name, $case->label());

        return  $result;
    }

}
