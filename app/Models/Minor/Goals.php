<?php

namespace App\Models\Minor;

use App\Enums\Entities;
use App\Models\Services\Log;
use App\Traits\hasContents;
use App\Traits\hasLinks;
use App\Traits\hasRelations;
use App\Traits\MagicGet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goals extends Model
{
    use SoftDeletes, hasRelations, hasContents;

    protected $table = 'goals';

    protected $fillable = [
        'content',
        'sort',
        'is_show',
        'is_approved',
        'relation_id',
        'relation_type',
    ];

    public function validateRules(): array
    {
        return [
            'content'       => '',
            'is_show'       => '',
            'is_approved'   => '',
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
            if(empty($item->sort))
                $item->sort = ($item->relation
                        ? self::where('relation_type', $item->relation::class)->where('relation_id', $item->relation->id)
                        : self::whereNull('relation_type')
                    )->max('sort') + 100;

        });

        static::saved(function ($item) {
            if($item->relation) {
                $item->relation
                    ->option('has_goals_in_moderation')
                    ->fill(['property' =>
                            $item->relation->goals()->count() === 0
                            || $item->relation->goals()->where('is_approved', false)->count() === 0]
                    )->save();

                $item->relation->saveCacheCabinetItem();
            }

            Log::add($item);
        });

        static::deleting(function ($item) {
            $item->contents()->delete();
        });
    }
    public function getCabinetSaveAttribute(): string
    {
        return route('goals.cabinet.save', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getCabinetFormAttribute(): string
    {
        return route('goals.cabinet.form', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('goals.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getSortUpAttribute(): string
    {
        return route('goals.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('goals.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }
}
