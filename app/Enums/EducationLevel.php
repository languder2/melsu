<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum EducationLevel: string
{
    case Bachelor       = 'bachelor';
    case Specialist     = 'specialist';
    case Master         = 'master';
    case Colleges       = 'colleges';
    case Postgraduate   = 'postgraduate';

    public function getName(): string
    {
        return match ($this) {
            self::Bachelor      => __('education-levels.Bachelor'),
            self::Specialist    => __('education-levels.Specialist'),
            self::Master        => __('education-levels.Master'),
            self::Colleges      => __('education-levels.Colleges'),
            self::Postgraduate  => __('education-levels.Postgraduate'),
        };
    }
    public function getAltName(): string
    {
        return match ($this) {
            self::Bachelor      => __('education-levels.BachelorAlt'),
            self::Specialist    => __('education-levels.SpecialistAlt'),
            self::Master        => __('education-levels.MasterAlt'),
            self::Colleges      => __('education-levels.CollegesAlt'),
            self::Postgraduate  => __('education-levels.PostgraduateAlt'),
        };
    }

    public static function getList(): Collection
    {
        $result =  collect([]);
        foreach (self::cases() as $case)
            $result->put($case->value, $case->getName());

        return  $result;
    }
    public static function getListAlt(): Collection
    {
        $result =  collect([]);
        foreach (self::cases() as $case)
            $result->put($case->value, $case->getAltName());

        return  $result;
    }

    public static function getOrder(): string
    {
        return "FIELD(level, 'bachelor', 'specialist', 'master', 'postgraduate', 'colleges')";
    }

}
