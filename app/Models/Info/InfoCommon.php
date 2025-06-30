<?php

namespace App\Models\Info;

use App\Enums\Info\CommonFields;
use App\Enums\Info\InfoType;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoCommon extends Info
{
    public function base(): array
    {
        return [
            CommonFields::fullName->name => (object)[
                'prop'      => CommonFields::fullName->name,
                'label'     => CommonFields::fullName->getName(),
                'type'      => 'string',
                'multi'     => false,
                'content'   => $this->fullName(),
            ],
            CommonFields::shortName->name => (object)[
                'prop'      => CommonFields::shortName->name,
                'label'     => CommonFields::shortName->getName(),
                'type'      => 'string',
                'multi'     => false,
                'content'   => $this->shortName(),
            ],
            CommonFields::regDate->name => (object)[
                'prop'      => CommonFields::regDate->name,
                'label'     => CommonFields::regDate->getName(),
                'type'      => 'date',
                'format'    => 'd.m.Y',
                'multi'     => false,
                'content'   => $this->regDate(),
            ],
            CommonFields::address->name => (object)[
                'prop'      => CommonFields::address->name,
                'label'     => CommonFields::address->getName(),
                'type'      => 'string',
                'content'   => $this->address(),
            ],
            CommonFields::availabilityOfBranches->name => (object)[
                'prop'      => CommonFields::availabilityOfBranches->name,
                'label'     => CommonFields::availabilityOfBranches->getName(),
                'type'      => 'boolean',
                'multi'     => false,
                'content'   => $this->branches(),
            ],
            CommonFields::availabilityOfRepresentative->name => (object)[
                'prop'      => CommonFields::availabilityOfRepresentative->name,
                'label'     => CommonFields::availabilityOfRepresentative->getName(),
                'type'      => 'boolean',
                'multi'     => false,
                'content'   => $this->representative(),
            ],
            CommonFields::workTime->name => (object)[
                'prop'      => CommonFields::workTime->name,
                'label'     => CommonFields::workTime->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->workTime(),
            ],
            CommonFields::telephone->name => (object)[
                'prop'      => CommonFields::telephone->name,
                'label'     => CommonFields::telephone->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->tel(),
            ],
            CommonFields::email->name => (object)[
                'prop'      => CommonFields::email->name,
                'label'     => CommonFields::email->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->email(),
            ],
        ];
    }

    public function fullName():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::fullName);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }
    public function shortName():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::shortName);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }
    public function regDate():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::regDate)->map(function ($item){
            return $item ? Carbon::createFromFormat('Y-m-d',$item)->format('d.m.Y') : 'Не указано';
        });

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;

    }
    public function address():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::address);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function branches():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function representative():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function workTime():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::address);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function tel():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::telephone);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function email():Collection
    {
        $result = $this->getContent(InfoType::Common,CommonFields::email);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function licenseDocLink(): array
    {
        return [
            'prop'      => CommonFields::licenseDocLink->name,
            'label'     => CommonFields::licenseDocLink->getName(),
            'documents' => $this->getDocuments(InfoType::Common,CommonFields::licenseDocLink),
        ];
    }

    public function accreditationDocLink(): array
    {
        return [
            'prop'      => CommonFields::accreditationDocLink->name,
            'label'     => CommonFields::accreditationDocLink->getName(),
            'documents' => $this->getDocuments(InfoType::Common,CommonFields::accreditationDocLink),
        ];
    }

    public function places(string $code): array
    {
        $code = CommonFields::tryFrom($code);

        return [
            'prop'      => $code->name,
            'label'     => $code->getName(),
            'list'      => $this->getContent(InfoType::Places,$code),
        ];
    }

}
