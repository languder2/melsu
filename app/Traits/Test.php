<?php
namespace App\Traits;

use Carbon\Carbon;

trait Test
{
    protected static function bootTest(): void
    {
        dump(Carbon::now()->format('H:i:s'));
    }
}
