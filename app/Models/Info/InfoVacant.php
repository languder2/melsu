<?php

namespace App\Models\Info;

use App\Enums\EducationLevel;
use App\Enums\Info\Budget;
use App\Enums\Info\Types;
use App\Enums\Info\Vacant;
use App\Models\Education\Profile;
use Illuminate\Support\Collection;

class InfoVacant extends Info
{

    protected const Types Type = Types::Vacant;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Vacant::cases());

        parent::__construct($arguments);
    }

    protected const array Fields = [
        Vacant::eduCode,
        Vacant::eduName,
        Vacant::eduProf,
        Vacant::eduLevel,
        Vacant::eduForm,
        Vacant::eduCourse,
        Vacant::numberBFVacant,
        Vacant::numberBRVacant,
        Vacant::numberBMVacant,
        Vacant::numberPVacant,
    ];

    public function list(Vacant $code):Collection
    {
        $list = collect([]);

        $profiles = Profile::where('show', true)
            ->get()
            ->where(function($item){
                return $item->speciality && $item->speciality->show && $item->speciality->level !== EducationLevel::Postgraduate;
            });

        foreach($profiles as $profile){
            $list->push($profile);
        }

        return $list;

    }
    public function template(string $code = 'vacant') : array
    {
        $code = $this->getCode($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'captions'          => self::Fields,
            'list'              => $this->list($code)
        ];
    }
    public function content(?string $code) : array
    {
        $code = $this->getCode($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'list'              => $this->getContent(self::Type, $code),
        ];
    }
}
