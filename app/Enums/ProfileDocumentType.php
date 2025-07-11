<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ProfileDocumentType
{
    case curriculum;
    case workProgram;
    case trainingSchedule;

    case description;
    case practiceProgram;
    case methodical;
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
