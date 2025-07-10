<?php

namespace App\Enums\Info;

use Illuminate\Support\Collection;

enum Objects
{
    /* cabinets */
    case purposeCab;

    case addressCab;
    case nameCab;
    case osnCab;
    case ovzCab;

    /* places of practice */

    case purposePrac;
    case addressPrac;
    case namePrac;
    case osnPrac;
    case ovzPrac;

    /* libraries */
    case purposeLibr;
    case objName;
    case objAddress;
    case objSq;
    case objCnt;
    case objOvz;

    /* sport */
    case purposeSport;

    /**/

    case ovz;
    case purposeFacil;
    case purposeFacilOvz;
    case comNet;
    case comNetOvz;
    case purposeEios;
    case erList;
    case erListOvz;
    case techOvz;
    case hostelInfo;
    case interInfo;
    case hostelNum;
    case hostelNumOvz;
    case interNum;
    case interNumOvz;
    case hostelInterOvz;
    case localActObSt;


    /* methods */
    public function getName(): string
    {
        return __("info.objects.{$this->name}");
    }

    public function label(): string
    {
        return __("info.objects.{$this->name}");
    }
    public static function list(): Collection
    {
        $list = collect();

        foreach (self::cases() as $case)
            $list->put($case->name, $case->label());

        return $list;
    }

    public function getModalForm(): string
    {
        return match ($this) {
            self::purposeCab    => "components.info.objects.forms.purpose-cab",
            self::purposePrac   => "components.info.objects.forms.purpose-prac",
            self::purposeLibr   => "components.info.objects.forms.purpose-libr",
            self::purposeSport  => "components.info.objects.forms.purpose-sport",
            default => null,
        };
    }

}
