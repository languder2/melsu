<?php

namespace App\Models\Minor;

use App\Enums\Entities;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graduation extends Model
{
    use SoftDeletes, hasRelations, hasContents, hasImage;

    protected $table = 'graduations';

    protected $fillable = [
        'name',
        'link',
        'sort',
        'is_show',
        'is_approved',
        'relation_id',
        'relation_type',
    ];

    protected $dates = ['deleted_at'];
    public function validateRules(): array
    {
        return [
            "name"              => "required|string",
            "link"              => '',
            'sort'              => '',
            'is_show'           => '',
            'is_approved'       => '',
        ];
    }
    public function validateMessages(): array
    {
        return [
            'name'              => 'Укажите название'
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if(empty($item->sort))
                $item->sort = ($item->relation
                        ? self::where('relation_type', $item->relation::class)->where('relation_id', $item->relation->id)
                        : self::whereNull('relation_type')
                    )->max('sort') + 100;
        });

        static::deleting(function ($item) {
            $item->image()->delete();
            $item->contents()->delete();
        });
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('graduations.cabinet.save', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }

    public function getCabinetFormAttribute(): string
    {
        return route('graduations.cabinet.form', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('graduations.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getSortUpAttribute(): string
    {
        return route('graduations.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('graduations.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }
}
