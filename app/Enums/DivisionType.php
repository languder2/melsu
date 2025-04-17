<?php

namespace App\Enums;

enum DivisionType: string
{
    case Rectorate = 'rectorate';
    case Branch         = 'branch';
    case Institute      = 'institute';
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
            self::Institute             => 'Институт',
            self::Faculty               => 'Факультет',
            self::Department            => 'Кафедра',
            self::Lab                   => 'Лаборатория',
            self::Administration        => 'Управление',
            self::Division              => 'Департамент',
            self::Office                => 'Отдел',
            self::Other                 => 'Иное',
        };
    }
    public function getSpecialityFiled():?string
    {
        return match ($this) {
            self::Institute             => 'institute_id',
            self::Faculty               => 'faculty_id',
            self::Department            => 'department_id',
            default                     => null,
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
