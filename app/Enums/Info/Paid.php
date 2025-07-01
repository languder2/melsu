<?php

namespace App\Enums\Info;

enum Paid
{
    case paidEdu;

    case paidDog;
    case paidSt;
    case paidParents;


    /* methods */
    public function getName(): string
    {
        return __("info.paid.{$this->name}");
    }
}
