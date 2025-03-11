<?php

namespace App\Enums;

enum DivisionType: string
{
    case Rectorate = 'rectorate';
    case Branch         = 'branch';
    case Faculty        = 'faculty';
    case Department     = 'department';
    case Lab            = 'lab';
    case Administration = 'administration';
    case Division       = 'division';
    case Office         = 'office';
    case Other          = 'other';
    public function getName():string
    {
        return match ($this) {
            self::Rectorate             => 'Ректорат',
            self::Branch                => 'Филиал',
            self::Faculty               => 'Факультет',
            self::Department            => 'Кафедра',
            self::Lab                   => 'Лаборатория',
            self::Administration        => 'Управление',
            self::Division              => 'Департамент',
            self::Office                => 'Отдел',
            self::Other                 => 'Иное',
        };
    }

    public static function forSelect():array
    {
        $result = [];

        foreach (self::cases() as $case)
            $result[$case->value] = $case->getName();

        return $result;

    }
}
