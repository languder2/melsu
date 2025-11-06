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

        $params = collect();
        if ($this->exists)
            $params->push($this->getRouteKey());

        $routeKey = Str::before($key, '_link');

        if (Str::endsWith($key, '_link')) {
            if (property_exists($this, 'links')) {

                if (isset($this->links[$routeKey])) {
                    $routeName = $this->links[$routeKey];

                    if (Route::has($routeName))
                        return route($routeName, $params);
                }
            }
            if (property_exists($this, 'linksGroups')) {
                foreach ($this->linksGroups as $key => $prefix)
                    if(Str::contains($routeKey, $key)){

                        $routeName = str_replace($key, $prefix, $routeKey);

                        if (Route::has($routeName))
                            return route($routeName, $params);
                    }
            }
        }


        return null;
    }
}
