<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Menu extends Model
{

    public static $FormMessage = [
        'name' => 'Укажите заголовок',
        'code' => 'Код уже занят'
    ];
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

    public static function FormRules($id)
    {
        return [
            'code' => "nullable|unique:menu,code,{$id},id",
            'name' => 'required',
            'comment' => '',
        ];
    }

    public static function GetList(): Collection
    {
        return self::orderBy('name')
            ->with('items')
            ->get();
    }

    public static function GetMainMenu(): Menu|null
    {
        $menu = self::where('code', 'main')
            ->with([
                'items' => function ($q) {
                    $q
                        ->where('parent_id', null)
                        ->orderBy('sort', 'asc')
                        ->get();
                }
            ])
            ->first();

        foreach ($menu->items ?? [] as $item) {

            $groups = [];

            $subs = MenuItems::where('parent_id', $item->id)
                ->orderBy('grp', 'asc')
                ->orderBy('sort', 'asc')
                ->orderBy('name', 'asc')
                ->get();

            foreach ($subs as $sub) {
                $groups[$sub->grp][] = $sub;
            }

            $item->sub = $groups;

        }

        return $menu;
    }

    public static function GetMenuForPage($menuID, $pageID)
    {
        $current = MenuItems::where([
            'menu_id' => $menuID,
            'page_id' => $pageID,
        ])
            ->first();

        $first = MenuItems::getFirstLevel($current->id);

        return $first;
    }

    public static function GetMenuFaculty($faculty, $page): array
    {
        return [
            (object)[
                'name' => $faculty->name,
                'link' => url("faculties/{$faculty->code}"),
                'active' => true,
                'subs' => [
                    (object)[
                        'name' => "О факультете",
                        'link' => url("faculties/{$faculty->code}"),
                        'active' => (bool)($page === 'about'),
                    ],
                    (object)[
                        'name' => "Деканат",
                        'link' => url("faculties/{$faculty->code}/staffs"),
                        'active' => (bool)($page === 'staffs'),
                    ],
                    (object)[
                        'name' => "Кафедры",
                        'link' => url("faculties/{$faculty->code}/departments"),
                        'active' => (bool)($page === 'departments'),
                    ],
                    (object)[
                        'name' => "Направление подготовки",
                        'link' => url("faculties/{$faculty->code}/specialities"),
                        'active' => (bool)($page === 'specialities'),
                    ],
                    (object)[
                        'name' => "Поступающим",
                        'link' => url('incoming'),
                        'active' => false,
                    ],
                    (object)[
                        'name' => "Наука",
                        'link' => url('science'),
                        'active' => false,
                    ],
                    (object)[
                        'name' => "Партнеры и выпускники",
                        'link' => url('partner'),
                        'active' => false,
                    ],
                ],
            ],
        ];
    }

    public static function GetMenuFaculties($list): array
    {

        $menu = [
            (object)[
                'name' => "Факультеты",
                'link' => url('faculties'),
                'active' => true,
                'subs' => [],
            ],
        ];

        foreach ($list as $faculty) {
            $menu[0]->subs[] = (object)[
                'name' => $faculty->name,
                'link' => url("faculties/{$faculty->code}"),
                'active' => false,
                'subs' => [],
            ];
        }

        return $menu;
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

    public static function getMenuFromMain($link):MenuItems|null
    {
        $menu = Menu::where('code', 'main')->first();

        $item = MenuItems::where('menu_id', $menu->id)->where('link', $link)->first();

        if(!$item)
            return null;

        return self::getMenuItemParent($item);
    }

    public static function getMenuItemParent(MenuItems $item): MenuItems
    {
        if($item->parent)
            return self::getMenuItemParent($item->parent);

        return $item;
    }


}
