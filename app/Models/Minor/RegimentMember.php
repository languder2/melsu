<?php

namespace App\Models\Minor;

use App\Enums\DivisionType;
use App\Enums\RegimentType;
use App\Models\Division\Division;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegimentMember extends Model
{
    use SoftDeletes;

    protected $table = 'regiment_members';

    protected $fillable = [
        'lastname',
        'firstname',
        'middle_name',
        'type',
        'letter',
        'content',
        'is_show',
        'sort',
    ];
    protected $casts = [
        'type'      => RegimentType::class,
        'is_show'   => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function () {
        });
    }

    public static function FormRules($id): array
    {
        return [
//            'test'              => "required",
            'lastname'          => "required",
            'firstname'         => "required",
            'middle_name'       => "",
            'type'              => "required",
            'sort'              => '',
            'is_show'           => '',
        ];
    }
    public static function FormMessage(): array
    {
        return [
            'lastname'          => 'Укажите фамилию',
            'firstname'         => 'Укажите имя',
            'type'              => 'Выберите принадлежность к полку',
        ];
    }

    public function getSortAttribute($sort): int
    {
        return ($sort > 0 && $sort < 1000) ? $sort :  0 ;
    }

    public function setSortAttribute($sort): void
    {
        $this->attributes['sort'] = $sort ?? 1000;
    }

    public function preview(): MorphOne | Image
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'photo')
            ?? new Image(['type'=>'photo']);
    }

}

