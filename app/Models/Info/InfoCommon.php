<?php

namespace App\Models\Info;

use App\Enums\Info\Common;
use App\Enums\Info\Types;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoCommon extends Info
{
    protected const Types Type = Types::Common;

    public function base(): array
    {
        return [
            Common::fullName->name => (object)[
                'prop'      => Common::fullName->name,
                'label'     => Common::fullName->getName(),
                'type'      => 'string',
                'multi'     => false,
                'content'   => $this->fullName(),
            ],
            Common::shortName->name => (object)[
                'prop'      => Common::shortName->name,
                'label'     => Common::shortName->getName(),
                'type'      => 'string',
                'multi'     => false,
                'content'   => $this->shortName(),
            ],
            Common::regDate->name => (object)[
                'prop'      => Common::regDate->name,
                'label'     => Common::regDate->getName(),
                'type'      => 'date',
                'format'    => 'd.m.Y',
                'multi'     => false,
                'content'   => $this->regDate(),
            ],
            Common::address->name => (object)[
                'prop'      => Common::address->name,
                'label'     => Common::address->getName(),
                'type'      => 'string',
                'content'   => $this->address(),
            ],
            Common::availabilityOfBranches->name => (object)[
                'prop'      => Common::availabilityOfBranches->name,
                'label'     => Common::availabilityOfBranches->getName(),
                'type'      => 'boolean',
                'multi'     => false,
                'content'   => $this->branches(),
            ],
            Common::availabilityOfRepresentative->name => (object)[
                'prop'      => Common::availabilityOfRepresentative->name,
                'label'     => Common::availabilityOfRepresentative->getName(),
                'type'      => 'boolean',
                'multi'     => false,
                'content'   => $this->representative(),
            ],
            Common::workTime->name => (object)[
                'prop'      => Common::workTime->name,
                'label'     => Common::workTime->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->workTime(),
            ],
            Common::telephone->name => (object)[
                'prop'      => Common::telephone->name,
                'label'     => Common::telephone->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->tel(),
            ],
            Common::email->name => (object)[
                'prop'      => Common::email->name,
                'label'     => Common::email->getName(),
                'type'      => 'text',
                'multi'     => false,
                'content'   => $this->email(),
            ],
        ];
    }

    public function fullName():Collection
    {
        $result = $this->getContent(Types::Common,Common::fullName);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }
    public function shortName():Collection
    {
        $result = $this->getContent(Types::Common,Common::shortName);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }
    public function regDate():Collection
    {
        $result = $this->getContent(Types::Common,Common::regDate)->map(function ($item){
            return $item ? Carbon::createFromFormat('Y-m-d',$item)->format('d.m.Y') : 'Не указано';
        });

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;

    }
    public function address():Collection
    {
        $result = $this->getContent(Types::Common,Common::address);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function branches():Collection
    {
        $result = $this->getContent(Types::Common,Common::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function representative():Collection
    {
        $result = $this->getContent(Types::Common,Common::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function workTime():Collection
    {
        $result = $this->getContent(Types::Common,Common::address);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function tel():Collection
    {
        $result = $this->getContent(Types::Common,Common::telephone);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function email():Collection
    {
        $result = $this->getContent(Types::Common,Common::email);

        if($result->isEmpty())
            $result->push('Не указано');

        return $result;
    }

    public function licenseDocLink(): array
    {
        return [
            'prop'      => Common::licenseDocLink->name,
            'label'     => Common::licenseDocLink->getName(),
            'documents' => $this->getDocuments(Types::Common,Common::licenseDocLink),
        ];
    }

    public function accreditationDocLink(): array
    {
        return [
            'prop'      => Common::accreditationDocLink->name,
            'label'     => Common::accreditationDocLink->getName(),
            'documents' => $this->getDocuments(Types::Common,Common::accreditationDocLink),
        ];
    }

    public function places(string $code): array
    {
        $code = Common::tryFrom($code);

        return [
            'prop'      => $code->name,
            'label'     => $code->getName(),
            'list'      => $this->getContent(Types::Places,$code),
        ];
    }

}
