<?php

namespace App\Enums\Projects;

use Illuminate\Support\Collection;

enum ClusterContentType:string
{
    case Relevance      = 'relevance';
    case Goals          = 'goals';
    case Structure      = 'structure';
    case Suggestions    = 'suggestions';

    public function getFullName():string
    {
        return match ($this) {
            self::Relevance     => __('projects.Relevance'),
            self::Goals         => __('projects.Goals and objectives'),
            self::Structure     => __('projects.Structure'),
            self::Suggestions   => __('projects.Suggestions for cooperation'),
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


