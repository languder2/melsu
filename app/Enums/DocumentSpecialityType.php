<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum DocumentSpecialityType: string
{
    case Curriculum         = 'curriculum';
    case WorkPrograms       = 'work-programs';
    case TrainingSchedule   = 'training-schedule';
    case PracticePrograms   = 'practice-programs';
    case Other              = 'other';


    public function getName(): string
    {
        return match ($this) {
            self::Curriculum            => 'Учебный план',
            self::WorkPrograms          => 'Рабочая программа',
            self::TrainingSchedule      => 'Календарный учебный график',
            self::PracticePrograms      => 'Рабочая программа практик',
            self::Other                 => 'Иное',
        };
    }
    public function getFullName(): string
    {
        return match ($this) {
            self::Curriculum            => 'Учебный план',
            self::WorkPrograms          => 'Рабочие программы',
            self::TrainingSchedule      => 'Календарный учебный график',
            self::PracticePrograms      => 'Рабочие программы практик',
            self::Other                 => 'Иные',
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
