<?php

namespace App\Models\Department;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Department\Department;

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
        return $this->MorphOne(Image::class, 'relation')->where('type', 'preview');
    }

    public function departments(bool $hidden = false, $trashed = null): MorphMany
    {

        $object = $this->morphMany(Department::class, 'relation');

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


}
