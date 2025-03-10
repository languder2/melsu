<?php

namespace App\Models\Menu;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Menu extends Model
{

    use softDeletes;

    protected $table = 'menu';
    protected $perPage = 20;

    protected $fillable = [
        'id',
        'name',
        'code',
        'parent_id',
        'comment',
        'show',
        'is_tree',
    ];

    public static function FormRules($id)
    {
        return [
            'code'      => "nullable|unique:menu,code,{$id},id",
            'name'      => 'required',
            'parent_id' => '',
            'comment'   => '',
        ];
    }
    public static function FormMessage():array
    {
        return [
            'name' => 'Укажите заголовок',
            'code' => 'Код уже занят'
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

            $subs = Item::where('parent_id', $item->id)
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
        $current = Item::where([
            'menu_id' => $menuID,
            'page_id' => $pageID,
        ])
            ->first();

        $first = Item::getFirstLevel($current->id);

        return $first;
    }

    public static function GetMenuFaculty($faculty, $page): object
    {
        return
            (object)[
                'name' => $faculty->name,
                'items' => [
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            self::class,
            'parent_id',
            "id",
        );
    }
    public function subs(): HasMany
    {
        return $this->hasMany(
            self::class,
            "parent_id",
            'id',
        );
    }
    public function items(): HasMany
    {
        return $this->hasMany(
            Item::class,
            "menu_id",
            'id',
        )->whereNull('parent_id')->orderBy('sort')->orderBy('name');
    }

    public function AllItems(): HasMany
    {
        return $this->hasMany(
            Item::class,
            "menu_id",
            'id',
        )->orderBy('sort')->orderBy('name');
    }

    public static function getMenuFromMain($link):Item|null
    {

        $menu = Menu::where('code', 'main')->first();

        if(!$menu)
            return null;

        $item = Item::where('menu_id', $menu->id)->where('link', $link)->first();

        if(!$item)
            $item = Item::where('menu_id', $menu->id)->where('link', url($link))->first();

        if(!$item)
            return null;

        $item->active = !$item->parent;

        $item =  $item->parent?self::getMenuItemParent($item,$link):$item;

        $item->subs->each(function($item) use ($link){
            $item->active = (bool)($item->link === url($link) || $item->link === $link);
        });

        return $item;
    }

    public static function getMenuItemParent(Item $item, $link): Item
    {
        if($item->parent)
            return self::getMenuItemParent($item->parent,$link);

        return $item;
    }

    public function getLinkAttribute(): string
    {
        return route('public:menu:show',[$this->code]);
    }


}
