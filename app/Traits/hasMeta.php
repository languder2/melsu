<?php

namespace App\Traits;

use App\Models\Gallery\Image;
use App\Models\Services\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

trait hasMeta
{
    public function getMetaCollection():MorphMany
    {
        return $this->morphMany(Meta::class, 'relation');
    }

    public function getMetaAttribute(): Collection
    {
        return $this->getMetaCollection->mapWithKeys(fn($item) => [$item->type => $item->content]);
    }

    public function metaSave(array $form, ?UploadedFile $image):void
    {
        foreach ($form as $type => $content)
            $this->getMetaCollection()->updateOrCreate(
                ['type' => $type],
                ['content' => $content]
            );

        if ($image)
            $this->getMetaCollection()->updateOrCreate(
                ['type' => 'og_image'],
                ['content' => Image::saveUploadFile($image)]
            );
    }

}
