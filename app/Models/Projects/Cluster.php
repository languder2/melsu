<?php

namespace App\Models\Projects;

use App\Models\News\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cluster extends Model
{

    use SoftDeletes;

    protected $table = 'project_clusters';

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_show',
        'sort',
    ];

    protected $cast = [

    ];

    protected $dates = ['deleted_at'];

    public function FormRules():array
    {
        return [
            'id'            => '',
            'name'          => "required|unique:news_categories,name,{$this->id},id,deleted_at,NULL",
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

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['sort'] = $attributes['sort'] ?? 1000;
            $attributes['code'] = str_replace(' ','-', $attributes['code']);
        }

        return parent::fill($attributes);
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

    public function getIdAttribute($value):int
    {
        return $value ?? microtime(true);
    }

    public function getAdminAttribute(): string
    {
        return route('clusters.admin', $this->id);
    }
    public function getNewAttribute(): string
    {
        return route('clusters.form');
    }
    public function getEditAttribute(): string
    {
        return route('clusters.form', $this->id);
    }
    public function getDeleteAttribute(): string
    {
        return route('clusters.delete', $this->id);
    }
    public function getSaveAttribute(): string
    {
        return route('clusters.save', $this->exists ? $this->id : null);
    }


}
