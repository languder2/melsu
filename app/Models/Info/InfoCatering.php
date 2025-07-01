<?php

namespace App\Models\Info;

use App\Enums\Info\Catering;
use App\Enums\Info\Types;
use Illuminate\Support\Collection;

class InfoCatering extends Info
{

    protected const Types Type = Types::Catering;

    protected const array Fields = [
        Catering::objName,
        Catering::objAddress,
        Catering::objSq,
        Catering::objCnt,
        Catering::objOvz,
    ];

    public function template(string $code) : array
    {
        $code = Catering::get($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'captions'          => self::Fields,
            'list'              => $this->list($code)

        ];
    }
    public function list(Catering $code):Collection
    {
        return Info::where('type',self::Type)->where('code',$code)->get()->keyBy('id')
            ->map(fn($item) => self::getFieldsByCaptions($item));
    }

    public static function getFieldsByCaptions($item): Collection
    {
        $list = collect([]);

        foreach (self::Fields as $field)
            $list->put(
                $field->name,
                    $item->subs()->where('code',$field)->first()->content
                    ?? __('info.empty')
            );

        return $list;
    }


}
