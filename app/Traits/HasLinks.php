<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;

trait HasLinks
{
    protected function getLinks(): array
    {
        return ['admin', 'edit', 'delete', 'list', 'show'];
    }
    protected function links(): Attribute
    {
        return Attribute::make(
            get: function (): Collection {
                return collect($this->getLinks())->mapWithKeys(function ($link) {
                    $routeName = "{$this->getTable()}.{$link}";
                    $url = Route::has($routeName) ? route($routeName, $this) : "#";

                    return [$link => $url];
                });
            }
        );
    }
}
