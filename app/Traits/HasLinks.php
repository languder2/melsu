<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait HasLinks
{
    use GenerateLinks;

    public $links;
    protected static function bootHasLinks():void
    {
        static::retrieved(function ($model) {
            $model->getLinksCollection();
        });
    }

    public function getLinksCollection(): void
    {
        $entity = $this->entity ?? $this->getTable();

        $this->generate(
            [
                'admin'     => "$entity:admin",
                'edit'      => "$entity:edit",
                'save'      => "$entity:save",
                'delete'    => "$entity:delete",
                'list'      => "$entity:list",
                'show'      => "$entity:show"
            ],
            [$this->id]
        );
    }
}

