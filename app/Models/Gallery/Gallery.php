<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Gallery\Image;

class Gallery extends Model
{
    public function images($all = null, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Image::class, 'relation');

        if (is_null($all))
            $object = $object->where('show', true);

        if (!is_null($trashed))
            $object = $object->withTrashed();

        return $object;
    }
}
