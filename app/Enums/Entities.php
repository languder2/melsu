<?php

namespace App\Enums;
use App\Models\Division\Division;
use App\Models\Education\Speciality;
use App\Models\Page\Page;
use App\Models\Staff\Staff;
use Illuminate\Support\Collection;

enum Entities: string
{
    case page           = 'pages';
    case division       = 'divisions';
    case speciality     = 'speciality';
    case staff          = 'staff';
    public static function list(): Collection
    {
        return collect(self::cases())->mapWithKeys(fn($item) => [$item->name => $item->label()]);
    }
    public function label(): string
    {
        return __("entities.{$this->value}");
    }
    public function model(): string
    {
        return match ($this) {
            self::page          => Page::class,
            self::division      => Division::class,
            self::speciality    => Speciality::class,
            self::staff         => Staff::class,
        };
    }
}
