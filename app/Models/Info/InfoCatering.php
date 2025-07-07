<?php

namespace App\Models\Info;

use App\Enums\Info\Catering;
use App\Enums\Info\Types;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

class InfoCatering extends Info
{

    protected const Types Type = Types::catering;

    public Catering $code;

    protected const array Fields = [
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
            'add'               => $this->form,
            'captions'          => self::Fields,
            'list'              => $this->list($this->code)

        ];
    }
    public function list(Catering $code):Collection
    {
        return Info::with('subs')->where('type',self::Type)->where('code',$code)->get()->keyBy('id')
            ->each(function($item) use ($code){
                $item->linkAdd = $item->linkAdd($code);
            })
            ;
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

    /* Links */

    public function getFormAttribute():string
    {
        return route('info:catering:form',[
            $this->code->name,
            $this->exists ? $this->id : null
        ]);
    }
    public function getSaveAttribute():string
    {
        return route('info:catering:save',[$this->exists ? $this->id : null]);
    }
    public function getDeleteAttribute():string
    {
        return route('info:catering:delete',$this->id);
    }
}
