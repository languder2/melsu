<?php

namespace App\Models\Info;

use App\Enums\Info\Budget;
use App\Enums\Info\Types;
use Illuminate\Support\Collection;

class InfoBudget extends Info
{

    protected const Types Type = Types::Budget;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Budget::cases());

        parent::__construct($arguments);
    }

    protected const array Fields = [
         Budget::volume->name => [
             Budget::finYear,
             Budget::finPost,
             Budget::finRas,
        ],
         Budget::current->name => [
             Budget::finBFVolume,
             Budget::finBRVolume,
             Budget::finBMVolume,
             Budget::finPVolume,
        ],
    ];

    public static function getFieldsByCaptions($item, Budget $code): Collection
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

    public function list(Budget $code):Collection
    {
        return Info::where('type',self::Type)
            ->where('code',$code)
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
            'list'              => $this->getContent(self::Type, $code),
        ];
    }
}
