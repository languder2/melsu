<?php

namespace App\Enums\Info;

enum BaseFields
{
    case copy;

    /* methods */
    public function getName(): string
    {
        return __("info.{$this->name}");
    }
}
