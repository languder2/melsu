<?php

namespace App\Enums;

use Illuminate\Support\Collection;
use function PHPUnit\Framework\matches;

enum ProfileDocumentType
{
    case listSpecialities;
    case listPractices;
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

    public static function getByName(string $code): ?self
    {
        foreach(self::cases() as $case)
            if($case->name === $code)
                return $case;

        return null;
    }
    public static function getByCode(string $code): ?self
    {
        foreach(self::cases() as $case)
            if($case->code() === $code)
                return $case;

        return null;
    }

    public function code(): ?string
    {
        return match($this){
            self::listSpecialities  => 'eduPred',
            self::listPractices     => 'eduPrac',
            self::curriculum        => 'educationPlan',
            self::workProgram       => 'educationRpd',
            self::trainingSchedule  => 'educationShedule',
            self::description       => 'opMain',
            self::practiceProgram   => 'eduPr',
            self::methodical        => 'methodology',
            default                 => null
        };
    }

}
