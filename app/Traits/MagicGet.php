<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait MagicGet
{
    public static array $magicGetPrefixes;
    public function __get($key)
    {
        if(!isset(static::$magicGetPrefixes))
            static::bootMagicGet();

        foreach (static::$magicGetPrefixes as $prefix => $fn)
            if (Str::endsWith($key, $prefix))
                return $this->{$fn}($key);

        return parent::__get($key);
    }
    protected static function bootMagicGet(): void
    {
        static::$magicGetPrefixes = collect(get_class_vars(static::class))
            ->filter(fn($value, $key) => Str::is('magicGetFor*', $key))
            ->mapWithKeys(fn($item) => [$item['prefix'] => $item['fn']])->toArray();
    }
}
