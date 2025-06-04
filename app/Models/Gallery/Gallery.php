<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = 'gallery';

    protected $fillable = [
        'id',
        'name',
        'code',
        'type',
        'description',
        'show',
        'order',
        'relation_id',
        'relation_type',
    ];

    public function FormRules(): array
    {
        return [
            'name'          => 'required',
            'code'          => "required|unique:gallery,code,{$this->id},id,deleted_at,NULL",
            'description'   => '',
            'order'         => 'nullable|numeric',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'preview'       => '',
            'show'          => '',
        ];
    }

    public function FormMessage(): array
    {
        return [
            'name' => 'Укажите название',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
        ];
    }

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['order'] = $attributes['order'] ?? 1000;
            if(array_key_exists('show',$attributes))
            $attributes['show']  = $attributes['show'] ? 1 : '';
        }

        return parent::fill($attributes);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function preview(): Image
    {
        return $this->images()->where('type','preview')->first()
            ?? (new Image(['type'=> 'preview', 'name' => $this->name]))->relation()->associate($this);
    }

    public function getPreviewAttribute():?string
    {
        return $this->preview()->src;
    }
    public function getThumbnailAttribute():?string
    {
        return $this->preview()->thumbnail;
    }

    public function adminImages():Collection
    {
        return $this->images()
            ->where('type','image')
            ->orderBy('order')
            ->get();
    }
    public function publicImages():Collection
    {
        return $this->images()
            ->where('type','image')
            ->where('show',1)
            ->get();
    }

    public function publicGallery(): Collection
    {
        return $this->images()
            ->where('show',true)
            ->whereNull('type')
            ->orderBy('order')
            ->get();
    }

    public function getOrderAttribute($order):int|null
    {
        return ($order !== 10000) ? $order : null;
    }

    /* Links */
    public function getUploadImagesAttribute():string
    {
        return route('gallery:images:upload',$this);
    }

    public function getAdminShowAttribute():string
    {
        return route('gallery:admin:show',$this);
    }

    public function getSaveAttribute():string
    {
        return route('gallery:admin:save',$this);
    }
    /* end links */



}
