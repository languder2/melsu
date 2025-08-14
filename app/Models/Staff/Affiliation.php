<?php

namespace App\Models\Staff;

use App\Enums\Info\Employees;
use App\Enums\Info\Types;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use App\Models\Info\Info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Collection\Collection;


class Affiliation extends Model
{

    use SoftDeletes;
    protected $table = 'staff_affiliation';

    protected $fillable = [
        'type',
        'staff_id',
        'full_name',
        'alt_name',
        'post',
        'post_alt',
        'order',
        'post_weight',
        'post_show',
        'show',
    ];

    public static function FormRules(): array
    {
        return [
//            'test'              => "required",
            'type'              => "",
            'staff_id'          => "required",
            'post'              => '',
            'post_alt'          => '',
            'order'             => '',
            'post_weight'       => '',
            'post_show'         => '',
            'show'              => '',
        ];
    }
    public static function FormMessage(): array
    {
        return [
            'name.required' => 'Укажите название',
            'name.unique' => 'Название уже занято',
        ];
    }

    public function fill(array $attributes):self
    {
        return parent::fill($attributes);
    }


    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
    public function getCard(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id','id');
    }
    public function getCardAttribute(): Staff
    {
        return $this->getCard ?? new Staff;
    }

    public function getOrderAttribute($order): int|null
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public static function ProcessingChief($record,$form):void
    {
        $staff= Staff::getOrCreate($form['staff_id'],$form['full_name']);

        if(!$staff) return;

        $chief = $record->chief;

        if(!$chief)
            $chief= new Affiliation(['type'      => 'chief']);


        $chief->fill([
            'post'          => $form['post'],
            'staff_id'      => $staff->id,
            'full_name'     => $staff->full_name,
            'order'         => $staff->order,
            'show'          => array_key_exists('show',$form),
        ])
            ->relation()->associate($record)
            ->save();

        $chief->save();
    }

    public static function ProcessingStaff($record,$aID,$form):void
    {
        $staff= Staff::getOrCreate($form['staff_id'],$form['full_name']);

        if(!$staff) return;

        $item = $record->staffs()->find($aID);

        if(!$item)
            $item = $record->staffs()->create([
                'type'  => 'staff',
            ]);

        $item->fill($form);
        $item->staff_id = $staff->id;
        $item->save();
    }

    public function getAvatarAttribute():?Image
    {
        return $this->card->avatar;
    }
    public function getFullNameAttribute():string
    {
        return $this->card->full_name;
    }

    public function getLinkAttribute():string
    {
        return $this->card->link;
    }
    public function options():MorphMany
    {
        return $this->morphMany(Options::class,'relation');
    }
    public function option(string $code):Options
    {
        return $this->options->where('code',$code)->first() ?? $this->options()->create(['code' => 'is_teacher']);
    }

    public function morphInfo(): MorphMany
    {
        return $this->morphMany( Info::class, 'relation');
    }
    public function infos($type,$code): Collection
    {
        return $this->morphInfo->where('type',$type)->where('code',$code);
    }
    public function info($code): Info
    {
        return $this->morphInfo->where('code',$code)->first()
            ?? $this->morphInfo()->create(['type' => Types::employees,'code' => $code]);
    }


    /* Links */
    public function getEditAttribute():?string
    {
        return route('division:admin:staffs:form', [$this->relation ?? 0, $this->type ?? 'staff', $this]);
    }
    public function getSaveAttribute():?string
    {
        return route('division:admin:staffs:save', [$this->relation ?? 0, $this->type ?? 'staff', $this]);
    }
    public function getDeleteAttribute():?string
    {
        return route('division:admin:staffs:delete', $this);
    }
    /* End Links */
}
