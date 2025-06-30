<?php

namespace App\Models\Info;

use App\Enums\DurationType;
use App\Enums\Info\DocumentsFields;
use App\Enums\Info\EducationFields;
use App\Enums\Info\InfoType;
use App\Enums\Info\ManagersFields;
use App\Enums\Info\StandardsFields;
use App\Models\Education\Profile;
use Illuminate\Support\Collection;

class InfoEducation extends Info
{

    public function template()
    {
        return [
            'label'             => EducationFields::eduAccred->getName(),
            'prop'              => EducationFields::eduAccred->name,
            'captions'          => [
                EducationFields::eduCode,
                EducationFields::eduName,
                EducationFields::eduProf,
                EducationFields::eduLevel,
                EducationFields::eduForm,
                EducationFields::learningTerm,
                EducationFields::eduPred,
                EducationFields::eduPrac,
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
