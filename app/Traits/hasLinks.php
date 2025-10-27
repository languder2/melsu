<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait hasLinks
{
    public function __get($key)
    {
        if (property_exists($this, 'links')) {
            if (\Illuminate\Support\Str::endsWith($key, '_link')) {

                $routeKey = \Illuminate\Support\Str::before($key, '_link');

                if (isset($this->links[$routeKey])) {
                    $routeName = $this->links[$routeKey];

                    $params = [];
                    if ($this->exists) {
                        $params[$this->getRouteKeyName()] = $this->getRouteKey();
                    }

                    dump($params);

                    if (Route::has($routeName)) {
                        return route($routeName, $params);
                    }
                }
            }
        }
        return parent::__get($key);
    }
}
