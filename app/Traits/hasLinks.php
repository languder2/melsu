<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
trait hasLinks
{
    protected array $magicGetForLinks = [
        'prefix'    => '_link',
        'fn'        => 'link_get',
    ];
    public function link_get($key): ?string
    {
        if (property_exists($this, 'links')) {
            if (Str::endsWith($key, '_link')) {

                $routeKey = Str::before($key, '_link');

                if (isset($this->links[$routeKey])) {
                    $routeName = $this->links[$routeKey];

                    $params = [];
                    if ($this->exists)
                        $params[] = $this->getRouteKey();

                    if (Route::has($routeName)) {
                        return route($routeName, $params);
                    }
                }
            }
        }

        return null;
    }
}
