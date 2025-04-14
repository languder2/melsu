<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum EventType: string
{
    case Preview    = 'preview';
    case Report     = 'report';
    public function getName():string
    {
        return match ($this) {
             self::Report       => __('event.Report'),
             self::Preview      => __('event.Preview'),
        };
    }

    public static function forSelect():Collection
    {
        $result = collect([]);

        foreach (self::cases() as $case) {
            $result->put($case->value, $case->getName());
        }

        return $result;
    }
}
