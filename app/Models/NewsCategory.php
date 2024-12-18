<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NewsCategory extends Model
{
    use SoftDeletes;

    protected $table = 'news_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'sort',
        'deleted_at',
    ];

    public static $FormRules = [
        'id'                => '',
        'name'              => 'required|unique',
        'sort'              => '',
        'publication_at'    => '',
    ];
    public static $FormMessage = [
        'name.required'     => 'Укажите заголовок',
        'name.unique'       => 'Название категории уже занято',
    ];

    public static function getListForSelect(?int $id = null): array
    {
        $response = [];

        $list= self::all();

        foreach ($list as $record)
            $response[$record->id] = $record->name;

        return $response;

    }

}
