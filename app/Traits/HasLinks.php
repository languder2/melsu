<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait HasLinks
{
    use GenerateLinks;

    public $links = [

    ];
    protected static function bootHasLinks():void
    {
//        static::creating(function ($model) {
//           dd($model);
//        });
//        static::created(function ($model) {
//           dd($model);
//        });

//        static::retrieved(function ($model) {
//            dd($model->links);
//        });
    }

    protected function initializeHasLinks()
    {

        $entity = $this->entity ?? $this->getTable();

        $this->links = collect([
                'admin'     => "$entity:admin",
                'edit'      => "$entity:edit",
                'save'      => "$entity:save",
                'delete'    => "$entity:delete",
                'list'      => "$entity:list",
                'show'      => "$entity:show"
            ]);
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

