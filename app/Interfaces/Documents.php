<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Documents
{
    public function documents(): MorphMany;
}
