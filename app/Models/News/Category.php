<?php

namespace App\Models\News;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Category extends Model
{
    use SoftDeletes;
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
    protected $table = 'news_categories';
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

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category', 'id')
            ->where('published_at', '<=', Carbon::now())
            ->orderBy('is_favorite', 'desc')
            ->orderBy('sort')
            ->orderBy('published_at', 'desc')
            ;
    }

    public function getIdAttribute($value):int
    {
        return $value ?? now()->format('Uv');
    }

    /* LINKS */
    public function getLinkAttribute(): string
    {
        return route('news-categories:public', $this->code ?? $this->id);
    }
    public function getAdminAttribute(): string
    {
        return route('news-categories:admin:list', $this->id);
    }
    public function getEditAttribute(): string
    {
        return route('news-categories:admin:form', $this->id);
    }
    public function getDeleteAttribute(): string
    {
        return route('news-categories:delete', $this->id);
    }
    public function getSaveAttribute(): string
    {
        return route('news-categories:save', $this->exists ? $this->id : null);
    }

    /**/

    public static function getForPublic():Collection
    {
        return self::orderBy('sort')->orderBy('name')->get()->pluck('name', 'link');
    }

    public function eventsRelation()
    {
        return $this->hasMany(Events::class, 'category_id');
    }
}
