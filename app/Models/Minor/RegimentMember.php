<?php

namespace App\Models\Minor;

use App\Enums\RegimentType;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property mixed $lastname
 * @property mixed $firstname
 * @property mixed $middle_name
 */
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
        'lastname'  => 'string',
        'type'      => RegimentType::class,
        'is_show'   => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($record) {
            $record->image()->delete();
        });

    }

    public static function FormRules(): array
    {
        return [
//            'test'              => "required",
            'lastname'          => "required",
            'firstname'         => "required",
            'middle_name'       => "",
            'type'              => "required",
            'content'           => "",
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

    public function image():MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'image');
    }
    public function getImageAttribute():Image
    {
        return
            $this->image()->first()
            ?? (new Image(['type' => 'image','name' => $this->full_name]))->relation()->associate($this);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->lastname} {$this->firstname} {$this->middle_name}";
    }

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = array_key_exists('is_show', $attributes);
            $attributes['letter']       = strtoupper(mb_substr($attributes['lastname'], 0, 1, 'UTF-8'));
            $attributes['sort']         = $attributes['sort'] ?? 1000;
        }

        return parent::fill($attributes);
    }

    public static function getMenu():Collection
    {
        $menu = collect([]);

//        self::getMenuItem($menu,RegimentType::Immortal,RegimentType::Both);
//        self::getMenuItem($menu,RegimentType::Scientific,RegimentType::Both);
//        self::getMenuItem($menu,RegimentType::Svo,null);


        $menu->put(RegimentType::Immortal->value,
            (object)[
                'name'      => RegimentType::Immortal->getFullName(),
                'link'      => route('regiment:public:list',RegimentType::Immortal),
                'type'      => RegimentType::Immortal,
                'subs'      =>
                    self::where('is_show', true)
                        ->where('type',RegimentType::Immortal)->orWhere('type',RegimentType::Both)
                        ->orderBy('lastname')->orderBy('firstname')->get()
                        ->map(function($member){ return (object)[
                            'name' => $member->full_name,
                            'link' => route('regiment:public:list','immortal')."#member-{$member->id}",
                            'active'    => false,
                        ];})
            ]
        );

        $menu->put(RegimentType::Scientific->value,
            (object)[
                'name'      => RegimentType::Scientific->getFullName(),
                'link'      => route('regiment:public:list',RegimentType::Scientific),
                'type'      => RegimentType::Scientific,
                'subs'      =>
                    self::where('is_show', true)
                        ->where('type',RegimentType::Scientific)->orWhere('type',RegimentType::Both)
                        ->orderBy('lastname')->orderBy('firstname')->get()
                        ->map(function($member){ return (object)[
                            'name' => $member->full_name,
                            'link' => route('regiment:public:list',RegimentType::Scientific)."#member-{$member->id}",
                            'active'    => false,
                        ];})
            ]
        );
        $menu->put(RegimentType::Svo->value,
            (object)[
                'name'      => RegimentType::Svo->getFullName(),
                'link'      => route('regiment:public:list',RegimentType::Svo),
                'type'      => RegimentType::Svo,
                'subs'      =>
                    self::where('is_show', true)
                        ->where('type',RegimentType::Svo)
                        ->orderBy('lastname')->orderBy('firstname')->get()
                        ->map(function($member){ return (object)[
                            'name' => $member->full_name,
                            'link' => route('regiment:public:list',RegimentType::Svo)."#member-{$member->id}",
                            'active'    => false,
                        ];})
            ]
        );

        return $menu;
    }

    public static function getMenuItem(Collection &$menu,RegimentType $type,?RegimentType $additional):void
    {


        $subs = self::where('is_show', true)
            ->where('type',$type);

        if($additional)
            $subs->orWhere('type',RegimentType::Both);

        $subs->orderBy('lastname')->orderBy('firstname')->get()
            ->map(function($member) use ($type) { return (object)[
                'name' => $member->full_name,
                'link' => route('regiment:public:list',$type)."#member-{$member->id}",
                'active'    => false,
            ];});

        dd($subs->get());


        $menu->put($type,
            (object)[
                'name'      => $type->getFullName(),
                'link'      => route('regiment:public:list',$type),
                'subs'      => $subs

            ]
        );

    }

}

