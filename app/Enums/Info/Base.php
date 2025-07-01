<?php

namespace App\Enums\Info;

enum Base
{
    case copy;

    /* methods */
    public function getName(): string
    {
        return __("info.{$this->name}");
    }
}
