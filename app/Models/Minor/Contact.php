<?php

namespace App\Models\Minor;

use App\Enums\ContactType;
use App\Enums\Entities;
use App\Models\Services\Log;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use softDeletes, hasRelations;
    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'title',
        'content',
        'type',
        'is_show',
        'is_approved',
        'sort',
        'relation_id',
        'relation_type',

    ];

    public function validateRules(): array
    {
        return [
            'title'         => "",
            'content'       => 'required',
            'type'          => "required",
            'is_show'       => '',
            'is_approved'   => '',
        ];
    }

    public function validateMessages(): array
    {
        return [
            'content'       => 'Укажите значение',
            'type'          => "Укажите тип",
        ];
    }

    protected $casts = [
        'is_show'   => 'boolean',
        'type'      => ContactType::class,
    ];

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
            if($item->relation)
                $item->relation
                    ->option('has_contacts_in_moderation')
                    ->fill(['property' =>
                        $item->relation->contacts()->count() === 0
                        || $item->relation->contacts()->where('is_approved',false)->count() === 0]
                    )->save();

            Log::add($item);
        });

        static::deleting(function ($item) {
        });
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('contacts.cabinet.save', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }

    public function getCabinetFormAttribute(): string
    {
        return route('contacts.cabinet.form', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('contacts.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id
        ]);
    }
    public function getSortUpAttribute(): string
    {
        return route('contacts.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('contacts.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }

}
