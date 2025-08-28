<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

trait GenerateLinks
{
    protected function generate(?string $group, array $links = [], array $attributes = [])
    {
        if($this->links instanceof Collection)
            $this->links = collect();

        $this->links->put(
            $group,
            collect($links)->mapWithKeys(
                fn ($route, $code) => [$code => Route::has($route) ? route($route, $attributes) : "#"]
            )
        );

    }
}
