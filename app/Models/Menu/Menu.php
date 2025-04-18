<?php

namespace App\Models\Menu;

use App\Models\Division\Division;
use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
    public function resolveRouteBinding($value, $field = null): ?Menu
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
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

    public static function GetMenuInstitute($division): object
    {
        $code = $division->code ?? $division->id;

        return
            (object)[
                'name'  => 'Институт',
                'items' => [
                    (object)[
                        'name' => "О институте",
                        'link' => route('public:education:division', ['institute',$code]),
                    ],
                    (object)[
                        'name' => "Факультеты",
                        'link' => route('public:education:division', ['institute',$code,'faculties']),
                    ],
                    (object)[
                        'name' => "Кафедры и лаборатории",
                        'link' => route('public:education:division', ['institute',$code,'departments']),
                    ],
                    (object)[
                        'name' => "Направление подготовки",
                        'link' => route('public:education:division', ['institute',$code,'specialities']),
                    ],
                    (object)[
                        'name' => "Поступающим",
                        'link' => "https://abiturient.mgu-mlt.ru/",
                    ],
                    (object)[
                        'name' => "Наука",
                        'link' => "https://melsu.ru/menu/science",
                    ],
                    (object)[
                        'name' => "История",
                        'link' => url('history'),
                    ],
                    (object)[
                        'name' => "Фотогалерея",
                        'link' => url('gallery'),
                    ],
                    (object)[
                        'name' => "Партнеры и выпускники",
                        'link' => url('partner'),
                    ],
                ],

            ];
    }
    public static function GetMenuFaculty($division): object
    {
        $code = $division->code ?? $division->id;

        return
            (object)[
                'name'  => 'Факультет',
                'items' => [
                    (object)[
                        'name' => "О факультете",
                        'link' => route('public:education:division', ['faculty',$code]),
                    ],
                    (object)[
                        'name' => "Деканат",
                        'link' => route('public:education:division', ['faculty',$code,'dean-office']),
                    ],
                    (object)[
                        'name' => "Педагогический состав",
                        'link' => route('public:education:division', ['faculty',$code,'teaching-staff']),
                    ],
                    (object)[
                        'name' => "Кафедры и лаборатории",
                        'link' => route('public:education:division', ['faculty',$code,'departments']),
                    ],
                    (object)[
                        'name' => "Направление подготовки",
                        'link' => route('public:education:division', ['faculty',$code,'specialities']),
                    ],
                    (object)[
                        'name' => "Поступающим",
                        'link' => "https://abiturient.mgu-mlt.ru/",
                    ],
                    (object)[
                        'name' => "Наука",
                        'link' => "https://melsu.ru/menu/science",
                    ],
                    (object)[
                        'name' => "История",
                        'link' => url('history'),
                    ],
                    (object)[
                        'name' => "Фотогалерея",
                        'link' => url('gallery'),
                    ],
                    (object)[
                        'name' => "Партнеры и выпускники",
                        'link' => url('partner'),
                    ],
                ],

            ];
    }

    public static function GetMenuDepartment($division): object
    {
        $code = $division->code ?? $division->id;

        $menu = (object)[
            'name'  => 'Кафедра',
            'items' => collect([
                (object)[
                    'name' => "О кафедре",
                    'link' => route('public:education:division', ['department', $code]),
                ],
            ]),
        ];

        if($division->staffs->count())
            $menu->items->push((object)[
                'name' => "Педагогический состав",
                'link' => route('public:education:division', ['department', $code, 'teaching-staff']),
            ]);

        if($division->labs->count())
            $menu->items->push((object)[
                'name' => "Лаборатории",
                'link' => route('public:education:division', ['department', $code, 'labs']),
            ]);

        if($division->specialities->count())
            $menu->items->push((object)[
                'name' => "Направление подготовки",
                'link' => route('public:education:division', ['department', $code, 'specialities']),
            ]);

        $menu->items->push((object)[
            'name' => "Поступающим",
            'link' => url('incoming'),
        ]);

        $menu->items->push((object)[
            'name' => "Наука",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "История",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "Фотогалерея",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "Партнеры и выпускники",
            'link' => url('partner'),
        ]);
        return $menu;
    }

    public static function GetMenuBranch($division): object
    {
        $code = $division->code ?? $division->id;

        $menu = (object)[
            'name'  => 'Колледж',
            'items' => collect([
                (object)[
                    'name' => "О колледже",
                    'link' => route('public:education:division', [$division->type, $code]),
                ],
            ]),
        ];

        if($division->staffs->count())
            $menu->items->push((object)[
                'name' => "Педагогический состав",
                'link' => route('public:education:division', [$division->type, $code, 'teaching-staff']),
            ]);

        if($division->labs->count())
            $menu->items->push((object)[
                'name' => "Лаборатории",
                'link' => route('public:education:division', [$division->type, $code, 'labs']),
            ]);

//        if($division->specialities->count())
//            $menu->items->push((object)[
//                'name' => "Направление подготовки",
//                'link' => route('public:education:branch:specialities', $code),
//                'active' => (bool)($page === 'specialities'),
//            ]);

        $menu->items->push((object)[
            'name' => "Поступающим",
            'link' => url('incoming'),
        ]);

        $menu->items->push((object)[
            'name' => "Наука",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "История",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "Фотогалерея",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "Наука",
            'link' => url('science'),
        ]);

        $menu->items->push((object)[
            'name' => "Партнеры и выпускники",
            'link' => url('partner'),
        ]);
        return $menu;
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

    public function ico(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'ico');
    }


}
