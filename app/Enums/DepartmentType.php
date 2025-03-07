<?php

namespace App\Enums;

enum DepartmentType: string
{
    case Rectorat = 'Rectorat';
    case Department = 'Department';
    case Branch = 'Branch';
    case Faculty = 'Faculty';
    case EducationDepartment = 'EducationDepartment';


    public function getType():string
    {
        return match ($this) {
            self::Rectorat              => 'Ректорат',
            self::Department            => 'Подразделение',
            self::Branch                => 'Филиал',
            self::Faculty               => 'Факультет',
            self::EducationDepartment   => 'Кафедра',
        };
    }
}
