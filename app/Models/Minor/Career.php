<?php

namespace App\Models\Minor;

use App\Enums\Entities;
use App\Models\Division\Division;
use App\Models\Services\Log;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes, hasRelations, hasContents, hasImage;

    protected $table = 'careers';

    protected $fillable = [
        'name',
        'salary_from',
        'salary_to',
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
            'salary_from'       => '',
            'salary_to'         => 'nullable|gt:salary_from',
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

        static::saved(function ($item) {
            if($item->relation instanceof Division) {
                $item->relation
                    ->option('has_careers_in_moderation')
                    ->fill(['property' =>
                            $item->relation->careers()->count() === 0
                            || $item->relation->careers()->where('is_approved', false)->count() === 0]
                    )->save();

                $item->relation->saveCacheCabinetItem();
            }
            Log::add($item);
        });


        static::deleting(function ($item) {
            $item->images()->delete();
            $item->contents()->delete();
        });
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('careers.cabinet.save', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }

    public function getCabinetFormAttribute(): string
    {
        return route('careers.cabinet.form', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('careers.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getSortUpAttribute(): string
    {
        return route('careers.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('careers.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }
}
