<?php
namespace App\Traits;

use Carbon\Carbon;

trait Test
{
    protected static function bootTest(): void
    {
        $model = new (static::class);

        dump($model->getTable());

        dd(Carbon::now()->format('H:i:s'));
    }
}
