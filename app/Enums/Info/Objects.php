<?php

namespace App\Enums\Info;

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
}
