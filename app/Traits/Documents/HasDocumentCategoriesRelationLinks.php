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
                    'admin'         => 'relation:documents:admin',
                    'edit'          => 'relation:document:categories:admin:form',
                    'documentAdd'   => 'relation:documents:add',
                ],
                [
                    $model->relation->getTable(),
                    $model->relation->id,
                    $model->id,
                ]
            );
        });
    }

}
