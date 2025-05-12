<?php

namespace App\Enums\Projects;

use Illuminate\Support\Collection;

enum ProjectType: string
{
    case Implemented    = 'implemented';
    case Currents       = 'currents';
    case Proposed       = 'proposed';

    public function getName(): string
    {
        return match ($this) {
            self::Implemented   => __('projects.Implemented'),
            self::Currents      => __('projects.Currents'),
            self::Proposed      => __('projects.Proposed for development')
        };
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
