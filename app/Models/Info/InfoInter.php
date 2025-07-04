<?php

namespace App\Models\Info;

use App\Enums\Info\Types;
use App\Enums\Info\InterFields;
use Illuminate\Support\Collection;

class InfoInter extends Info
{
    protected const Types Type = Types::inter;

    protected const array Fields = [
        InterFields::stateName,
        InterFields::orgName,
        InterFields::dogReg,
    ];

    protected InterFields $type = InterFields::internationalDog;

    public function template() : array
    {
        return [
            'label'             => $this->type->getName(),
            'prop'              => $this->type->name,
            'captions'          => self::Fields,
            'list'              => $this->list($this->type)

        ];
    }
    public function list($type):Collection
    {
        return Info::where('type',self::Type)->where('code',$type)->get()->keyBy('id')
            ->map(fn($item) => self::getFieldsByCaptions($item));
    }

    public static function getFieldsByCaptions($item): Collection
    {
        $list = collect([]);

        foreach (self::Fields as $field)
            $list->put($field->name,$item->subs()->where('code',$field)->first()->content
                ?? __('info.empty'));

        return $list;
    }


}
