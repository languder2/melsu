<?php

namespace App\Enums;

enum ContactType: string
{
    case Phone          = 'phone';
    case Email          = 'email';
    case Address        = 'address';
    case Telegram       = 'telegram';
    public function getName(): string
    {
        return match ($this) {
            self::Phone         => 'Телефон',
            self::Email         => 'Email',
            self::Address       => 'Адрес',
            self::Telegram      => 'Телеграм',
        };
    }

    public function getIco(): string
    {
        return match ($this) {
            self::Phone         => '<i class="fas fa-phone-alt"></i>',
            self::Email         => '<i class="fas fa-envelope"></i>',
            self::Address       => '<i class="fas fa-map-marked-alt"></i>',
            self::Telegram      => '<i class="fab fa-telegram-plane"></i>',
        };
    }

    public function getPreLink(): string
    {
        return match ($this) {
            self::Phone         => "phone:",
            self::Email         => "mailto:",
            default             => '',
        };
    }
    public function getInputType(): string
    {
        return match ($this) {
            self::Phone         => "tel",
            self::Email         => "email",
            self::Telegram      => "url",
            default             => '',
        };
    }

    public static function getSortedCasesByName()
    {

        $result = [];
        foreach (self::cases() as $case)
            $result[$case->name] = $case->getName();

        sort($result);

        return collect($result);

    }
}
