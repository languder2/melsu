<?php

namespace App\Models\Page;

use App\Models\Page\Content as PageContent;
use App\Traits\HasAdminMenu;
use App\Traits\HasDocumentCategories;
use App\Traits\HasDocuments;
use App\Traits\HasLinks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
    use SoftDeletes, HasLinks, HasAdminMenu, HasDocumentCategories, HasDocuments;

    protected $table = 'pages';

    protected string $entity = 'pages';

    protected $fillable = [
        'id',
        'name',
        'alias',
        'route',
        'comment',

        'parent_id',

        'title',
        'keywords',
        'description',

        'menu_id',
        'view',
        'content',

        'without_bg'

    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($page) {
            $page->sections()->delete();
        });
    }
    public static function FormMessage():array{
        return [
            'name' => 'Укажите заголовок',
            'route.required_without' => 'Alias или Route должны быть заполнены',
            'alias.required_without' => 'Alias или Route должны быть заполнены',

        ];
    }
    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alias' => "nullable|unique:pages,alias,{$id},id,deleted_at,NULL|required_without:route",
            'comment' => '',
            'route' => 'required_without:alias',
            'parent_id' => '',
            'title' => '',
            'keywords' => '',
            'description' => '',
            'view' => '',
            'sidebar' => '',
            'content' => '',
            'menu_id' => '',
            'without_bg' => '',
        ];
    }
    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation')->orderBy('order');
    }

    public static function GetList(): Collection
    {
        return self::orderBy('name')
            ->with([
                'parent',
            ])
            ->get();
    }

    public static function GelLinkByID($id): string|null
    {
        $page = self::find($id);

        if (is_null($page))
            return null;

        if (!is_null($page->route) && Route::has($page->route))
            return url($page->route);

        elseif (!is_null($page->alias))
            return url($page->alias);

        return null;
    }

    public function getLinkAttribute(): string|null
    {

        if (!is_null($this->route) && Route::has($this->route))
            return url($this->route);

        elseif (!is_null($this->alias))
            return url($this->alias);

        return null;
    }


    public static function breadcrumbs(&$list,$page): void
    {
        if($page->parent)
            self::breadcrumbs($list,$page->parent);

        $list[] = (object)[
            'link'      => $page->link,
            'title'     => $page->name,
        ];

    }


//    public static function breadcrumbs($pageID): array
//    {
//        $breadcrumbs = self::getBreadCrumbs($pageID);
//
//        return [
//            'current' => array_slice($breadcrumbs, -1)[0],
//            'last' => array_slice($breadcrumbs, -2, 1)[0],
//            'list' => array_slice($breadcrumbs, 0, count($breadcrumbs) - 2),
//        ];
//    }
//
//    public static function getBreadCrumbs($pageID)
//    {
//        $breadcrumbs = [];
//
//        $page = self::with('parent')->find($pageID);
//
//        if (!is_null($page->parent))
//            $breadcrumbs = array_merge($breadcrumbs, self::getBreadCrumbs($page->parent->id));
//
//        $link = '#';
//
//        if (Route::has($page->route))
//            $link = url(route($page->route));
//
//        if ($page->alias)
//            $link = url($page->alias);
//
//        $breadcrumbs[] = (object)[
//            'name' => $page->name,
//            'link' => $link
//        ];
//
//        return $breadcrumbs;
//    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id', 'id');
    }

}
