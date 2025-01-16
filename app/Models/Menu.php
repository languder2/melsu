<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MenuCategories;
use Illuminate\Support\Collection;

class Menu extends Model
{

    protected $table = 'menu';

    protected $fillable = [
        'id',
        'category',
        'name',
        'comment',
        'link',
        'route',
        'parent',
        'sort',
        'created_at',
        'deleted_at',
    ];

    public static $FormMessage = [
        'name'                      => 'Укажите заголовок',
        'link.required_without'     => 'Link или Route должны быть заполнены',
        'route.required_without'    => 'Link или Route должны быть заполнены',
    ];

    public static function FormRules($id):array
    {
        return [
            'category'          => '',
            'name'              => 'required',
            'comment'           => '',
            'link'              => 'required_without:route',
            'route'             => 'required_without:link',
            'parent'            => '',
            'sort'              => 'nullable|numeric',
        ];
    }

    public function categoryRecord(): BelongsTo
    {
        return $this->belongsTo(MenuCategories::class, 'category', 'id');
    }

    public static function GetList():Collection
    {
        return self::orderBy('sort')
            ->orderBy('name',)
            ->with([
                'categoryRecord',
            ])
            ->get();
    }

    public static function GetListByCategory():array
    {
        $list= self::orderBy('sort')
            ->orderBy('name',)
            ->with([
                'categoryRecord',
            ])
            ->get();

        $response = [];

        foreach ($list as $item){
            if(!isset($response[$item->categoryRecord->name]))
                $response[$item->categoryRecord->name] = (object)[
                    'detail'        => $item->categoryRecord,
                    'menu'          => []
                ];

            $response[$item->categoryRecord->name]->menu[] = $item;
        }

        ksort($response);

        return $response;
    }



}
