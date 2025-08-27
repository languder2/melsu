<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Documents\DocumentCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
trait HasDocuments
{
    protected array $routes = [
        'categoryAdd'  => 'relation:document:categories:admin:form',
        'admin'         => 'relation:documents:admin',
    ];
    protected function documentLinks(): Attribute
    {
        return Attribute::make(
            get: function (): Collection
            {
                return collect($this->routes)->mapWithKeys(
                    fn ($route, $code) => [$code => Route::has($route) ? route($route, [$this->getTable(), $this]) : "#"]
                );
            }
        );
    }
    public function documentCategories():MorphMany
    {
        return $this->morphMany(DocumentCategory::class, 'relation')
            ->whereNull('parent_id')
        ;
    }
    public function publicDocumentCategories(): Collection
    {
        return $this->documentCategories()->public()->get();
    }
    public function trashedDocumentCategories(): Collection
    {
        return $this->documentCategories()->onlyTrashed()->get();
    }

}
