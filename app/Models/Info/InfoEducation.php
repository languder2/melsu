<?php

namespace App\Models\Info;

use App\Enums\DurationType;
use App\Enums\EducationLevel;
use App\Enums\Info\Documents;
use App\Enums\Info\Education;
use App\Enums\Info\Grants;
use App\Enums\Info\Objects;
use App\Enums\Info\Types;
use App\Enums\Info\Managers;
use App\Enums\Info\Standards;
use App\Enums\Info\Vacant;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use Illuminate\Support\Collection;

class InfoEducation extends Info
{
    protected const Types Type = Types::Education;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Education::cases());

        parent::__construct($arguments);
    }

    protected const array Fields = [
        Education::eduAccred->name => [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::eduLevel,
            Education::eduForm,
            Education::learningTerm,
            Education::eduPred,
            Education::eduPrac,
        ],
        Education::eduOp->name => [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::eduLevel,
            Education::eduForm,

            Education::opMain,
            Education::educationPlan,
            Education::educationRpd,
            Education::educationShedule,
            Education::eduPr,
            Education::methodology,
        ],
        Education::eduNir->name => [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::eduLevel,

            Education::perechenNir,
            Education::napravNir,
            Education::resultNir,
            Education::baseNir,
        ],
        Education::graduateJob->name => [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::v1,
            Education::t1,
        ],
    ];

    public function eduAccredList():Collection
    {
        $list = collect([]);

        $specialities = Speciality::where('show', true)
            ->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->orderBy('name_profile')
            ->get();

        foreach($specialities as $speciality){
            foreach($speciality->public_profiles as $profile){
                if($speciality->courses)
                    for($i=1; $i<=$speciality->courses; $i++){

                        $course = $profile->getCourse($i);

                        $list->push(
                            (object)[
                                'speciality'        => $speciality,
                                'profile'           => $profile,
                                'infos'              => $speciality->infos
                            ]
                        );
                    }
            }
        }

        return $list;
    }
    public function eduAccred() : array
    {
        return [
            'label'             => Education::eduAccred->getName(),
            'prop'              => Education::eduAccred->name,
            'captions'          => self::Fields[Education::eduAccred->name],
            'list'              => $this->eduAccredList()

        ];
    }
    public function eduOpList():Collection
    {
        $list = collect([]);

        $specialities = Speciality::where('show', true)
            ->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->orderBy('name_profile')
            ->get();

        foreach($specialities as $speciality){
            foreach($speciality->public_profiles as $profile){
                $list->push(
                    (object)[
                        'speciality'        => $speciality,
                        'profile'           => $profile,
                        'infos'              => $speciality->infos
                    ]
                );
            }
        }

        return $list;
    }
    public function eduOp() : array
    {
        return [
            'label'             => Education::eduOp->getName(),
            'prop'              => Education::eduOp->name,
            'captions'          => self::Fields[Education::eduOp->name],
            'list'              => $this->eduOpList()

        ];
    }
    public function eduAdOpList():Collection
    {
        $list = collect([]);

        $specialities = Speciality::where('show', true)
            ->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->orderBy('name_profile')
            ->get()
            ->where(fn($item) => $item->option('optionValue') === true);

        foreach($specialities as $speciality){
            foreach($speciality->public_profiles as $profile){
                $list->push(
                    (object)[
                        'speciality'        => $speciality,
                        'profile'           => $profile,
                        'infos'              => $speciality->infos
                    ]
                );
            }
        }

        return $list;
    }
    public function eduAdOp() : array
    {
        return [
            'label'             => Education::eduAdOp->getName(),
            'prop'              => Education::eduAdOp->name,
            'captions'          => self::Fields[Education::eduOp->name],
            'list'              => $this->eduAdOpList()

        ];
    }
    public function eduNirList():Collection
    {
        $list = collect([]);

        $specialities = Speciality::where('show', true)
            ->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->orderBy('name_profile')
            ->get();

        foreach($specialities as $speciality){
            foreach($speciality->public_profiles as $profile){
                $list->push(
                    (object)[
                        'speciality'        => $speciality,
                        'profile'           => $profile,
                        'infos'              => $speciality->infos
                    ]
                );
            }
        }

        return $list;
    }
    public function eduNir() : array
    {
        return [
            'label'             => Education::eduNir->getName(),
            'prop'              => Education::eduNir->name,
            'captions'          => self::Fields[Education::eduNir->name],
            'list'              => $this->eduNirList()

        ];
    }

    public function graduateJobList():Collection
    {
        return Speciality::where('show', true)
            ->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->orderBy('name_profile')
            ->get();

    }
        public function graduateJob() : array
    {
        return [
            'label'             => Education::graduateJob->getName(),
            'prop'              => Education::graduateJob->name,
            'captions'          => self::Fields[Education::graduateJob->name],
            'list'              => $this->graduateJobList()

        ];
    }

}
