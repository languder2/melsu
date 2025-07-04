<?php

namespace App\Models\Info;

use App\Enums\Info\Founder;
use App\Enums\Info\Employees;
use App\Enums\Info\Types;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoFounder extends Info
{

    public const Types Type = Types::founder;

    public Collection $codes;

    public const Founder Base = Founder::uchredLaw;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Employees::cases());

        parent::__construct($arguments);
    }

    public const array Fields = [
        Founder::nameUchred,
        Founder::addressUchred,
        Founder::telUchred,
        Founder::mailUchred,
        Founder::websiteUchred,
    ];

    public function getSaveAttribute(): string
    {
        return route('info:founder:save',$this->exists ? $this->id : null);
    }
//    public function getDeleteAttribute(): string
//    {
//        return route('info:founder:delete',$this->exists ? $this->id : null);
//    }


    public function template(): array
    {
        return [
            'prop'              => Founder::uchredLaw->name,
            'label'             => Founder::uchredLaw->getName(),
            'captions'          => self::Fields,
            'list'              => $this->list(),
        ];
    }
    public function list(): Collection
    {
        $list = $this->getRecords(Types::founder,$this::Base);

        $list->each(function ($item) {

            $subs = $item->subs;

            $item->fields = collect([
                "nameUchred"    => $subs->where('code',Founder::nameUchred)->first(),
                "addressUchred" => $subs->where('code',Founder::addressUchred)->first(),
                "telUchred"     => $subs->where('code',Founder::telUchred)->first(),
                "mailUchred"    => $subs->where('code',Founder::mailUchred)->first(),
                "websiteUchred" => $subs->where('code',Founder::websiteUchred)->first(),
            ]);
        });

        return $list;
    }

    public function getSubsValue($code): ?string
    {

        $record = $this->subs->where('code',$code)->first();

        return $record ? $record->content : null;
    }

}
