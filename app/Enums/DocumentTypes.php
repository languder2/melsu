<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum DocumentTypes
{
    case instruction;
    case jobDescription;
    case order;
    case plan;
    case regulation;
    case appendix;
    case articlesCollection;
    case other;
    public function label(): string
    {
        return __("documents.types.{$this->name}");
    }
    public static function list(): Collection
    {
        $list = collect();

        foreach (self::cases() as $case){
            $list->put($case->name, $case->label());
        }

        return $list;
    }

}
