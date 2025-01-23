<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItems;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{

    protected $table = 'menu';

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
            'code'              => "nullable|unique:menu,code,{$id},id",
            'name'              => 'required',
            'comment'           => '',
        ];
    }

    public function items(): BelongsToMany
    {
        return $this->BelongsToMany(
            MenuItems::class,
            "menu",
            'id',
            'id',
            null,
            'menu_id',
        );
    }

    public static function GetList():Collection
    {
        return self::orderBy('name')
            ->with('items')
            ->get();
    }

    public static function GetMainMenu():Menu
    {
        $menu= self::where('code','main')
            ->with([
                'items' => function ($q) {
                    $q
                        ->where('parent_id',null)
                        ->orderBy('sort', 'asc')
                        ->get();
                }
            ])
            ->first();

        foreach ($menu->items as $item){

            $groups = [];

            $subs = MenuItems::where('parent_id',$item->id)
                ->orderBy('grp','asc')
                ->orderBy('sort','asc')
                ->orderBy('name','asc')
                ->get();

            foreach ($subs as $sub){
                $groups[$sub->grp][]= $sub;
            }

            $item->sub = $groups;

        }

        return $menu;
    }

    public static function GetMenuForPage($menuID,$pageID)
    {
        $current        = MenuItems::where([
                'menu_id'       => $menuID,
                'page_id'       => $pageID,
            ])
            ->first();

        $first          = MenuItems::getFirstLevel($current->id);

        return $first;
    }

}
