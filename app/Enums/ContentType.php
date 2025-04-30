<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ContentType:string
{
    case Short          = 'Short';
    case Full           = 'Full';
    case Content        = 'Content';

    public function getFullName():string
    {
        return match ($this) {
            self::Short         => __('news.Short Description'),
            self::Full          => __('regiment.Full Description'),
            self::Content       => __('regiment.Content'),
        };
    }

    public static function pluck():Collection
    {
        $result = collect([]);

        foreach (self::cases() as $case)
            $result->put($case->value,$case->getFullName());

        return $result;
    }

}
