<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

trait GenerateLinks
{
    /**
     * @param array $links
     * @param array $attributes
     * @return void
     */
    protected function generate(array $links = [], array $attributes = []):void
    {
        if(!($this->links instanceof Collection))
            $this->links = collect();

        $generatedLinks = collect($links)->mapWithKeys(
            fn ($route, $code) => [$code => Route::has($route) ? route($route, $attributes) : '#']
        );

        $this->links = $this->links->merge($generatedLinks);
    }
}
