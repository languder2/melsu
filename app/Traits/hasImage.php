<?php

namespace App\Traits;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait hasImage
{
    public function getImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'relation')->where('type', 'logo');
    }

    public function getImageAttribute(): Image
    {
        return $this->getImage()->firstOrNew();
    }



}
