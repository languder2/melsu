<?php

namespace App\Models\Info;

use App\Enums\Info\Catering;
use App\Enums\Info\Types;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

class InfoCatering extends Info
{

    public const Types Type = Types::catering;

    public Catering $code;

    public const array Fields = [
        Catering::objName,
        Catering::objAddress,
        Catering::objSq,
        Catering::objCnt,
        Catering::objOvz,
    ];

    public function template(string $code) : array
    {

        $this->code = Catering::get($code);

        return [
            'label'             => $this->code->getName(),
            'prop'              => $this->code->name,
            'captions'          => self::Fields,
            'list'              => $this->list($this->code)

        ];
    }
    public function list(Catering $code):Collection
    {
        return self::where('type',self::Type)->where('code',$code)
            ->orderBy('sort','desc')->orderBy('content','asc')
            ->get()->keyBy('id')
            ->each(function($item) use ($code){
                $item->fields = $item->getFieldsByCaptions();
            })
            ;
    }

    public function getFieldsByCaptions(): Collection
    {
        $list = collect([]);

        $subs = $this->subs;

        foreach (self::Fields as $field)
            $list->put(
                $field->name,
                    $subs->where('code',$field)->first()->content
                    ?? __('info.empty')
            );

        return $list;
    }

    /* Links */

    public function getSaveAttribute():string
    {
        return route('info:catering:save',[$this->exists ? $this->id : null]);
    }
    public function getDeleteAttribute():string
    {
        return route('info:catering:delete',$this->id);
    }

}
