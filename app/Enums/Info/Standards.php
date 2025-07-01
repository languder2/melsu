<?php

namespace App\Enums\Info;

enum Standards
{
    case eduFedDoc;
    case eduStandartDoc;
    case eduFedTreb;
    case eduStandartTreb;

    /* methods */
    public function getName(): string
    {
        return __("info.standards.{$this->name}");
    }
}
