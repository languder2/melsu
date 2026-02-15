<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum UserRoles: string
{
    case User           = 'user';
    case Finance        = 'finance';
    case Editor         = 'editor';
    case Admin          = 'admin';
    case Super          = 'super';
    private const LEVELS = [
        'user'          => 0,
        'finance'       => 2,
        'editor'        => 5,
        'admin'         => 9,
        'super'         => 10,
    ];
    public function level(): int
    {
        return self::LEVELS[$this->value];
    }
    public function label(): string
    {
        return __("user-roles.{$this->value}");
    }
    public function getListBySet(): Collection
    {
        return collect(self::cases())->filter(fn ($case) => $case->level() < $this->level());
    }

    public function forSelect():array
    {
        $result = [];

        foreach ($this->getListBySet() as $case)
            $result[$case->value] = $case->label();

        return $result;
    }

}
