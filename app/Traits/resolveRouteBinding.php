<?php

namespace App\Traits;

trait resolveRouteBinding
{
    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }
}
