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


}
