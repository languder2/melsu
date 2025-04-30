<?php

namespace App\Enums\Services;

use Illuminate\Support\Collection;

enum MetaTypes:string
{
    case Title          = 'title';
    case Keywords       = 'keywords';
    case Description    = 'description';

    /**
     * @return string
     */
    public function getName(): string
    {
        return  __("services.meta.{$this->value}");
    }

    /**
     * @return Collection
     */
    public static function pluck():Collection
    {
        $result = collect([]);

        foreach (self::cases() as $case)
            $result->put($case->value,$case->getName());

        return $result;
    }

}
