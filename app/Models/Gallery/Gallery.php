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

    public static function FormRules($id): array
    {
        return [
            'name'          => 'required',
            'code'          => "required|unique:gallery,code,{$id},id,deleted_at,NULL",
            'description'   => '',
            'order'         => 'nullable|numeric',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'preview'       => '',
            'show'          => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите название',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
        ];
    }

    public function preview(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'preview');
    }

    public function images(bool $hidden = false, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Image::class, 'relation');

//        $object->where(function ($query) {
//            $query->where('type', '!=', 'preview')
//                ->orWhereNull('type');
//        });

        if(!$hidden)
            $object->where('show',true);


        if ($trashed === 'include')
            $object = $object->withTrashed();

        if ($trashed === 'only')
            $object = $object->onlyTrashed();

        $object = $object->orderBy('order')->orderBy('name');

        return $object;
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


    public function getAddImagesAttribute():string
    {
        return route('gallery:images:add',$this);
    }

    /* end links */



}
