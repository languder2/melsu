<?php

namespace App\Traits;

use App\Models\Documents\DocumentCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
trait HasDocuments
{

    protected static function bootHasDocuments():void
    {
        static::retrieved(function ($model) {
            $model->generate(
                'documents',
                [
                    'admin'         => 'relation:documents:admin',
                ],
                [$model->getTable(), $model->id]
            );
        });
    }

}
