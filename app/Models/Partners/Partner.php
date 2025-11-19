<?php

namespace App\Models\Partners;

use App\Enums\Entities;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{

    use SoftDeletes, hasRelations, hasImage, hasContents;

    protected $table = 'partners';

    protected $fillable = [
        'name',
        'link',
        'category_id',
        'is_show',
        'is_approved',
        'sort',
        'relation_id',
        'relation_type',
    ];

    protected $casts = [
        'show_title' => 'boolean',
        'show' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if(!$item->sort || (int)$item->sort < 0)

                $item->sort = 100 +
                    (
                        $item->category_id
                        ? $item->category->partners()->max('sort')
                        : $item->relation->partners()->max('sort')
                    )
                ;
        });

        static::deleting(function ($item) {});
    }

    public function validateRules(): array
    {
        return [
            'name'          => 'required',
            'link'          => '',
            'category_id'   => '',
            'is_show'       => '',
            'is_approved'   => '',
            'sort'          => '',
            'image'         => '',
            'content'       => ''
        ];
    }
    public function validateMessages(): array
    {
        return [
            'name.required' => 'Название обязательно'
        ];
    }

    public function getCabinetSaveAttribute(): string
    {
        return  route('partners.cabinet.save',[
            'entity'        => Entities::getEntityByModel($this->relation::class)->value,
            'entity_id'     => $this->relation->id,
            $this->id
        ]);
    }

    public function getFormAttribute(): string
    {
        return route('partners.cabinet.form',[
            'entity'    => Entities::getEntityByModel($this->relation::class)->value,
            'entity_id' => $this->relation->id,
            $this->id
        ]);
    }

    public function getSortUpAttribute(): string
    {
        return route('partners.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'up'
        ]);
    }
    public function getSortDownAttribute(): string
    {
        return route('partners.cabinet.change-sort', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
            'down'
        ]);
    }
    public function getDeleteAttribute(): string
    {
        return route('partners.cabinet.delete', [
            Entities::getEntityByModel($this->relation::class)->value,
            $this->relation->id,
            $this->id,
        ]);
    }

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
