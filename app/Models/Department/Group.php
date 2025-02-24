<?php

namespace App\Models\Department;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Department\Department;
use Illuminate\Support\Facades\Storage;

class Group extends Model
{
    use SoftDeletes;

    protected $table = 'department_groups';
    protected $fillable = [
        'id',
        'name',
        'alias',
        'description',
        'show',
        'order'
    ];

    public static function FormRules($id): array
    {
        return [
            'name'          => "required|unique:department_groups,name,$id,id,deleted_at,NULL",
            'alias'         => "nullable|unique:department_groups,alias,$id,id,deleted_at,NULL",
            'description'   => '',
            'show'          => '',
            'order'         => '',
            'image'         => '',
            'preview'       => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name.required'     => 'Укажите название',
            'name.unique'       => 'Название уже занято',
            'alias.unique'      => 'Alias уже занят',
        ];
    }

    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?? 10000;
    }

    public function getOrderAttribute($value)
    {
        return $value !== 10000 ? $value : null;
    }
    public function preview(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview');

        if(!$image->count())
            $image->create([
                'type'      => 'preview',
                'name'      => $this->name,
            ])->save();

        return $image;
    }

//    public function getPreviewAttribute()
//    {
//        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview')->first();
//
//        return $image ?? (object)[
//            'thumbnail' => Image::placeholder(),
//            'src' => Image::placeholder(),
//        ];
//    }
    public function departments(bool $hidden = false, $trashed = null): HasMany
    {

        $object = $this->hasMany(Department::class);

//        $object->where(function ($query) {
//            $query->where('type', '!=', 'preview')
//                ->orWhereNull('type');
//        });

//        if(!$hidden)
//            $object->where('show',true);


        if ($trashed === 'include')
            $object = $object->withTrashed();

        if ($trashed === 'only')
            $object = $object->onlyTrashed();

        $object = $object->orderBy('order')->orderBy('name');

        return $object;
    }


}
