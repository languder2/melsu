<?php

namespace App\Models\Info;

use App\Enums\DurationType;
use App\Enums\Info\Documents;
use App\Enums\Info\Education;
use App\Enums\Info\Types;
use App\Enums\Info\Managers;
use App\Enums\Info\Standards;
use App\Models\Education\Profile;
use Illuminate\Support\Collection;

class InfoEducation extends Info
{

    public function template()
    {
        return [
            'label'             => Education::eduAccred->getName(),
            'prop'              => Education::eduAccred->name,
            'captions'          => [
                Education::eduCode,
                Education::eduName,
                Education::eduProf,
                Education::eduLevel,
                Education::eduForm,
                Education::learningTerm,
                Education::eduPred,
                Education::eduPrac,
            ],
            'list'              => $this->specialities()

        ];
    }
    public function specialities():Collection
    {
        return Profile::where('show',true)->get()->keyBy('id')->where(function ($item){
            return $item->speciality && $item->speciality->show;
        })->map(function ($item){
            return [
                'eduCode'       => $item->speciality->spec_code,
                'eduName'       => $item->speciality->name,
                'eduProf'       => $item->speciality->name_profile,
                'eduLevel'      => $item->speciality->level->getName(),
                'eduForm'       => $item->form->getName(),
                'learningTerm'  => $item->formatedDuration(DurationType::OOO),
                'eduPred'       => __('info.empty'),
                'eduPrac'       => __('info.empty'),
            ];
        });
    }



}
