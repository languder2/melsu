<?php

namespace App\Models\Events;

use App\Traits\hasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, hasEvents;
    public function FormRules():array
    {
        return [
            'id'            => '',
            'name'          => "required|unique:event_categories,name,{$this->id},id,deleted_at,NULL",
            'code'          => "nullable|unique:news_categories,code,{$this->id},id,deleted_at,NULL",
            'sort'          => '',
        ];
    }

    public function FormMessage():array
    {
        return [
            'name.required' => 'Укажите название категории',
            'name.unique'   => 'Категория с таким названием уже существует',
            'code.unique'   => "Категория с таким alias'ом уже существует",
        ];
    }
    protected $table = 'event_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'sort',
    ];
    protected $visible = [
        'id',
        'name',
        'code',
        'link',
    ];
    protected $appends = ['link'];
    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['sort'] = $attributes['sort'] ?? 1000;
            $attributes['code'] = str_replace(' ','-', $attributes['code']);
        }

        return parent::fill($attributes);
    }

    public function eventsRelation()
    {
        return $this->hasMany(Events::class, 'category_id');
    }

}
