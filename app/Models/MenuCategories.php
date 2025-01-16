<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuCategories extends Model
{

    protected $table = 'menu_categories';

    protected $perPage = 10;

    protected $fillable = [
        'id',
        'code',
        'name',
        'comment',
        'created_at',
        'deleted_at',
    ];

    public static $FormMessage = [
        'name'              => 'Укажите заголовок',
        'code'              => 'Код уже занят'
    ];

    public static function FormRules($id)
    {
        return  [
            'code'              => "nullable|unique:menu_categories,code,{$id},id",
            'name'              => 'required',
            'comment'           => '',
        ];
    }

    public function menu(): HasOne
    {
        return $this->hasOne(Menu::class,"category");
    }

    public static function GetList():Collection
    {

        return self::orderBy('name')
            ->withCount('menu')
            ->get();
    }

}
