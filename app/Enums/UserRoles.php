<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum UserRoles: string
{
    case User           = 'user';
    case Editor         = 'editor';
    case Admin          = 'admin';
    case Super          = 'super';
    private const NAMES = [
        'user'          => 'user-roles.user',
        'editor'        => 'user-roles.editor',
        'admin'         => 'user-roles.admin',
        'super'         => 'user-roles.super',
    ];
    private const LEVELS = [
        'user'          => 0,
        'editor'        => 5,
        'admin'         => 9,
        'super'         => 10,
    ];
    public function level(): int
    {
        return self::LEVELS[$this->value];
    }
    public function getName(): string
    {
        return __(self::NAMES[$this->value]);
    }
    public function getListBySet(): Collection
    {
        return collect(self::cases())->filter(fn ($case) => $case->level() <= $this->level());
    }

    public function forSelect():array
    {
        $result = [];

        foreach ($this->getListBySet() as $case)
            $result[$case->value] = $case->getName();

        return $result;

    }

}
