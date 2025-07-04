<?php

namespace App\Enums\Info;

enum Common : string
{
    case fullName                       = 'fullName';
    case shortName                      = 'shortName';
    case regDate                        = 'regDate';
    case address                        = 'address';
    case workTime                       = 'workTime';
    case telephone                      = 'telephone';
    case email                          = 'email';
    case licenseDocLink                 = 'licenseDocLink';
    case accreditationDocLink           = 'accreditationDocLink';
    case addressPlaceSet                = 'addressPlaceSet';
    case addressPlacePrac               = 'addressPlacePrac';
    case addressPlacePodg               = 'addressPlacePodg';
    case addressPlaceGia                = 'addressPlaceGia';
    case addressPlaceDop                = 'addressPlaceDop';
    case addressPlaceOppo               = 'addressPlaceOppo';
    case availabilityOfBranches         = 'availabilityOfBranches';
    case availabilityOfRepresentative   = 'availabilityOfRepresentative';

    /* methods */
    public function getName(): string
    {
        return __("info.common.{$this->name}");
    }
    public function label(): string
    {
        return __("info.common.{$this->name}");
    }
}
