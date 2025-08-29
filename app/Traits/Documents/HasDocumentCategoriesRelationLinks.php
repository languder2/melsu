<?php

namespace App\Traits\Documents;

use App\Traits\GenerateLinks;

trait HasDocumentCategoriesRelationLinks
{
    use GenerateLinks;
    protected static function bootHasDocumentCategoriesRelationLinks():void
    {
        static::retrieved(function ($model) {

            $model->generate(
                [
                    'admin' => 'relation:documents:admin',
                ],
                [
                    $model->relation->getTable(),
                    $model->relation->id
                ]
            );
        });
    }

}
