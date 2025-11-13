<?php

namespace App\Models\Partners;

use App\Enums\Entities;
use App\Traits\hasDivision;
use App\Traits\hasRelations;
use App\Traits\hasSubordination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, hasRelations, hasSubordination;

    protected $table = 'partner_categories';

    protected $fillable = [
        'name',
        'sort'
    ];

    public function validateRules(): array
    {
        return [
            'name'          => '',
            'sort'          => '',
        ];
    }
    public function validateMessages(): array
    {
        return [];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if(!$item->sort || (int)$item->sort < 0)
                $item->sort = $item->relation->partnerCategories()->max('sort') + 100;
        });
    }

    public function cabinetForm(): string
    {
        return route('partner-categories.cabinet.form',[
            'entity'    => Entities::getEntityByModel($this->relation::class)->value,
            'entity_id' => $this->relation->id,
            $this->id
        ]);
    }

    public function cabinetSave(): string
    {
        return route('partner-categories.cabinet.save',[
            'entity'    => Entities::getEntityByModel($this->relation::class)->value,
            'entity_id' => $this->relation->id,
            $this->id
        ]);
    }

    public function getSortUpAttribute(): string
    {
        return route('partner-categories.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('partner-categories.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }


}
