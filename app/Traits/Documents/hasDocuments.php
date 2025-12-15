<?php

namespace App\Traits\Documents;

trait HasDocuments
{

    protected static function bootHasDocuments():void
    {
        static::retrieved(function ($model) {
            $model->generate(
                [
                    'admin' => 'relation:documents:admin',
                ],
                [
                    $model->getTable(),
                    $model->id
                ]
            );
        });
    }

}
