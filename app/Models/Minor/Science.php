<?php

namespace App\Models\Minor;

use App\Enums\Entities;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Science extends Model
{
    use SoftDeletes, hasRelations, hasContents, hasImage;

    protected $table = 'sciences';

    protected $fillable = [
        'name',
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
            $item->images()->delete();
            $item->contents()->delete();
        });
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('science.cabinet.save', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }

    public function getCabinetFormAttribute(): string
    {
        return route('science.cabinet.form', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('science.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getSortUpAttribute(): string
    {
        return route('science.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('science.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }
}
