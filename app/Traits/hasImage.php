<?php

namespace App\Traits;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

trait hasImage
{
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function getImagesAttribute(): Collection
    {
        return $this->images()->get()->keyBy('id');
    }

    public function getImage($type = 'logo'): MorphOne
    {
        return $this->morphOne(Image::class, 'relation')->where('type', $type);
    }

    public function getLogoAttribute(): Image
    {
        return $this->getImage()->firstOrNew();
    }

    public function getImageAttribute(): Image
    {
        $image = $this->getImage('image')->firstOrNew();

        if(!$image->exists)
            $image->fill(['type' => 'image', 'path' => 'images/placeholder.png']);

        return $image;
    }

    public function getPreviewAttribute(): Image
    {
        $image = $this->getImage('preview')->firstOrNew();

        if(!$image->exists)
            $image->fill(['type' => 'preview', 'path' => 'images/placeholder.png']);

        return $image;
    }

}
