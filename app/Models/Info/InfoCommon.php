<?php

namespace App\Models\Info;

use App\Enums\Info\Common;
use App\Enums\Info\Employees;
use App\Enums\Info\Types;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoCommon extends Info
{
    public const Types Type = Types::common;

    public Collection $codes;
    public function __construct(...$arguments)
    {
        $this->codes = collect(Common::cases());

        parent::__construct($arguments);
    }

    public const array Fields = [
        Common::fullName,
        Common::shortName,
        Common::regDate,
        Common::address,
        Common::availabilityOfBranches,
        Common::availabilityOfRepresentative,
        Common::workTime,
        Common::telephone,
        Common::email,
    ];

    public function template(): array
    {
        $list = [];

        foreach (self::Fields as $field)
            $list[$field->name] = $this->getField($this::Type,$field);

        return [
            'list' => $list
        ];
    }

    public function branches():Collection
    {
        $result = $this->getContent(Types::common,Common::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function representative():Collection
    {
        $result = $this->getContent(Types::common,Common::availabilityOfBranches)
            ->map(function ($item){
                return (bool) $item ? 'Имеются' : 'Отсутствуют';
            });

        if($result->isEmpty())
            $result->push('Отсутствуют');

        return $result;
    }

    public function places(string $code): array
    {
        $code = Common::tryFrom($code);

        return [
            'prop'      => $code->name,
            'label'     => $code->getName(),
            'list'      => $this->getRecords(Types::places,$code),
        ];
    }

}
