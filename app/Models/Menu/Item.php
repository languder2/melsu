<?php

namespace App\Models\Menu;

use App\Models\Gallery\Image;
use App\Models\Page\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

class Item extends Model
{

    protected $table = 'menu_items';

    protected $fillable = [
        'id',
        'menu_id',
        'name',
        'comment',
        'link',
        'route',
        'parent_id',
        'page_id',
        'sort',
        'show',
    ];

    public static function FormRules($id): array
    {
        return [
            'menu_id'           => '',
            'name'              => 'required',
            'comment'           => '',
            'link'              => '',
            'route'             => '',
            'grp'               => '',
            'page_id'           => '',
            'parent_id'         => '',
            'sort'              => 'nullable|numeric',
            'show'              => '',
            'image'             => '',
            'preview'           => '',
        ];
    }

    public static function FormMessage():array
    {
        return [
            'name' => 'Укажите заголовок',
            'link.required_without' => 'Page, Link или Route должны быть заполнены 1',
            'route.required_without' => 'Page, Link или Route должны быть заполнены 2',
            'page_id.required_without' => 'Page, Link или Route должны быть заполнены 3',
        ];
    }

    public static function GetList(): Collection
    {
        return self::orderBy('sort')
            ->orderBy('name')
            ->with([
                'menu',
                'page',
                'parent',
            ])
            ->get();
    }

    public static function GetListByMenu(): array
    {
        $list = self::where('parent_id', null)
            ->orderBy('menu_id')
            ->orderBy('grp')
            ->orderBy('sort')
            ->orderBy('name')
            ->with([
                'menu',
                'page',
                'parent',
            ])
            ->get();

        $response = [];

        foreach ($list as $item) {
            if (!isset($response[$item->menu->name]))
                $response[$item->menu->name] = (object)[
                    'detail' => $item->menu,
                    'menu' => []
                ];

            $response[$item->menu->name]->menu[] = $item;
            self::AddSub($response[$item->menu->name]->menu, $item->id);
        }

        ksort($response);

        return $response;
    }

    public static function AddSub(&$arr, $id): void
    {

        $list = self::where('parent_id', $id)
            ->orderBy('grp')
            ->orderBy('sort')
            ->orderBy('name')
            ->with([
                'page',
                'parent',
            ])
            ->get();

        if ($list->count())
            foreach ($list as $item) {
                $arr[] = $item;
                self::AddSub($arr, $item->id);
            }
    }

    public static function GelListForForm(): Collection
    {
        $list = self::where('parent_id', null)
            ->orderBy('sort')
            ->orderBy('name')
            ->with('menu')
            ->get();

        foreach ($list as $item) {
            $item->name = "{$item->menu->name}: {$item->name}";
            $item->attrs = [
                'data-menu' => $item->menu->id,
            ];

        }

        return $list;
    }

    public static function getFirstLevel($id)
    {
        $item = self::with('parent')->find($id);

        if (!is_null($item->parent))
            return self::with('parent')->find($item->parent->id);

        return $item;
    }

    public static function getSideMenuForPage($menuID, $pageID)
    {
        $current = self
            ::where([
                'menu_id' => $menuID,
                'page_id' => $pageID,
            ])
            ->first();

        if (is_null($current))
            return null;

        self::getParents($allActive, $current->id);

        return self::getMenuTree($menuID, $allActive);
    }

    public static function getParents(&$list, $currentID): void
    {
        $item = Item::find($currentID);

        if ($item->parent_id)
            self::getParents($list, $item->parent_id);

        $list[] = $currentID;
    }

    public static function getMenuTree($menuID, $allActive, $parentID = null)
    {
        $tree = [];

        $arr = self
            ::where([
                'menu_id' => $menuID,
                'parent_id' => $parentID,
            ])
            ->orderBy('grp', 'asc')
            ->orderBy('sort', 'asc')
            ->orderBy('name')
            ->get();

        if ($arr->count() === 0) return null;

        foreach ($arr as $item)
            $tree[] = (object)[
                'name' => $item->name,
                'link' => $item->link,
                'active' => (bool)in_array($item->id, $allActive),
                'subs' => self::getMenuTree($menuID, $allActive, $item->id),
            ];

        return $tree;
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'parent_id', 'id');
    }

    public function subs(): hasMany
    {
        return $this->hasMany(Item::class, 'parent_id', 'id')
            ->orderBy('sort')
            ->orderBy('name')
        ;
    }

    public function preview(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview');

        if(!$image->count())
            $image->create([
                'type'      => 'preview',
                'name'      => $this->name,
            ])->save();

        return $image;
    }

    public function getSortAttribute($sort): int|null
    {
        return ($sort < 10000) ? $sort :  null ;
    }

    public function setSortAttribute($sort): void
    {
        $this->attributes['sort'] = $sort ?? 10000;
    }


    public function LinkedPage(): BelongsTo|null
    {

        return $this->page_id
            ? $this->belongsTo(Page::class, 'page_id', 'id')
            : null;

    }

}
