<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum DivisionType: string
{
    case Rectorate = 'rectorate';
    case Representative = 'representative';
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
        return __('divisions.type.'.$this->value);
    }
    public function label():string
    {
        return __('divisions.type.'.$this->value);
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

    public static function list():Collection
    {
        return collect(self::cases())->mapWithKeys(fn ($item) =>[$item->value => $item] );
    }

    public static function labels():Collection
    {
        return self::list()->mapWithKeys(fn($item, $key) => [$key => __('divisions.type.'.$item->value)]);
    }

    public static function forSelect():array
    {
        $result = [];

        foreach (self::cases() as $case)
            $result[$case->value] = $case->getName();

        return $result;

    }

    public function getField():string
    {
        return match ($this) {
            DivisionType::Faculty       => 'faculty_id',
            DivisionType::Department    => 'department_id',
            DivisionType::Institute     => 'institute_id',
        };
    }

    public function getDivisionMenu($division)
    {
        $op = $division->code ?? $division->id;

        return match ($this) {
            DivisionType::Faculty     =>
            (object)[
                'name'  => 'Факультет',
                'items' => [
                    (object)[
                        'name' => "О факультете",
                        'link' => route('public:education:division', ['faculty',$op]),
                    ],
                    (object)[
                        'name' => "Деканат",
                        'link' => route('public:education:division', ['faculty',$op,'dean-office']),
                    ],
                    (object)[
                        'name' => "Педагогический состав",
                        'link' => route('public:education:division', ['faculty',$op,'teaching-staff']),
                    ],
                    (object)[
                        'name' => "Кафедры и лаборатории",
                        'link' => route('public:education:division', ['faculty',$op,'departments']),
                    ],
                    (object)[
                        'name' => "Направления подготовки",
                        'link' => route('public:education:division', ['faculty',$op,'specialities']),
                    ],
                    (object)[
                        'name'  => "Поступающим",
                        'link'  => "https://abiturient.mgu-mlt.ru/",
                    ],
                    (object)[
                        'name'  => "Новости",
                        'link'  => route('public:education:division', ['faculty',$op,'news']),
                        'hide'  => $division->news->isEmpty(),
                    ],

//                    (object)[
//                        'name' => "Наука",
//                        'link' => "https://melsu.ru/menu/science",
//                    ],
//                    (object)[
//                        'name' => "Наука",
//                        'link' => "https://melsu.ru/menu/science",
//                    ],
//                    (object)[
//                        'name' => "История",
//                        'link' => url('history'),
//                    ],
//                    (object)[
//                        'name' => "Фотогалерея",
//                        'link' => url('gallery'),
//                    ],
//                    (object)[
//                        'name' => "Партнеры и выпускники",
//                        'link' => url('partner'),
//                    ],
                ],
            ],
            default                     => null,
        };
    }

}
