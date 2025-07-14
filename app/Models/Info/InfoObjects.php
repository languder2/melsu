<?php

namespace App\Models\Info;

use App\Enums\Info\Catering;
use App\Enums\Info\Types;
use App\Enums\Info\Objects;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class InfoObjects extends Info
{
    public const string routeNameForm   = 'info:objects:form';
    public const string routeNameSave   = 'info:objects:save';
    public const string routeNameDelete = 'info:objects:delete';

    public const Types Type = Types::objects;

    public Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Objects::cases());

        parent::__construct($arguments);
    }

    public const array Fields = [
        Objects::purposeCab->name => [
            Objects::addressCab,
            Objects::nameCab,
            Objects::osnCab,
            Objects::ovzCab,
        ],
        Objects::purposePrac->name => [
            Objects::addressPrac,
            Objects::namePrac,
            Objects::osnPrac,
            Objects::ovzPrac,
        ],
        Objects::purposeLibr->name => [
            Objects::objName,
            Objects::objAddress,
            Objects::objSq,
            Objects::objCnt,
            Objects::objOvz,
        ],
        Objects::purposeSport->name => [
            Objects::objName,
            Objects::objAddress,
            Objects::objSq,
            Objects::objCnt,
            Objects::objOvz,
        ],
    ];

    public static function getFieldsByCaptions($item, Objects $code): Collection
    {
        $list = collect([]);

        foreach (self::Fields[$code->name] as $field)
            $list->put(
                $field->name,
                $item->subs()->where('code',$field)->first()->content
                ?? __('info.empty')
            );

        return $list;
    }

    public function list(Objects $code):Collection
    {
        return Info::where('type',self::Type)
            ->where('code',$code)
            ->orderBy('sort','desc')
            ->orderBy('content','asc')
            ->get()
            ->keyBy('id')
            ->map(fn($item) => self::getFieldsByCaptions($item,$code));
    }
    public function template(string $code = 'purposeCab') : array
    {
        $code = $this->getCode($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'routeForm'         => $this::routeNameForm,
            'routeDelete'       => $this::routeNameDelete,
            'captions'          => self::Fields[$code->name],
            'list'              => $this->list($code)

        ];
    }
    public function content(?string $code) : array
    {
        $code = $this->getCode($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'type'              => $this::Type->name,
            'route'             => 'info:form',
            'list'              => $this->getContent(self::Type, $code),
        ];
    }
}
