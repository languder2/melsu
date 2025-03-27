<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use SoftDeletes;

    public static $FormRules = [
        'id' => '',
        'name' => 'required|unique',
        'sort' => '',
        'published_at' => '',
    ];
    public static $FormMessage = [
        'name.required' => 'Укажите заголовок',
        'name.unique' => 'Название категории уже занято',
    ];
    protected $table = 'news_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'sort',
    ];
    protected $visible = [
        'name',
        'sort',
    ];

    public static function getListForSelect(?int $id = null): array
    {
        $response = [];

        $list = self::all();

        foreach ($list as $record)
            $response[$record->id] = $record->name;

        return $response;
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category', 'id')
            ->orderBy('published_at', 'desc')
            ->orderBy('name');
    }


}
