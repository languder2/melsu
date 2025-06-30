<?php

namespace App\Models\Info;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class InfoBase extends Info
{

    const array MENU = [
        'common',
        'struct',
        'document',
        'education',
        'eduStandarts',
        'managers',
        'employees',
        'objects',
        'grants',
        'paid_edu',
        'budget',
        'vacant',
        'inter',
        'catering',
    ];

    public function getMenu(): Collection
    {
        $menu = collect();

        foreach (self::MENU as $item)
            $menu->put($item,(object)[
                "href"      => route("info:{$item}"),
                "label"     => __("info-menu.{$item}"),
                "active"    => Route::is("info:{$item}")
            ]);

        return $menu;
    }
}
