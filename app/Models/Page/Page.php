<?php

namespace App\Models\Page;

use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use App\Models\Page\Content as PageContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
//    use SoftDeletes, HasLinks, HasAdminMenu;
//    use HasDocumentCategories, HasDocuments;
    use SoftDeletes;

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
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id', 'id');
    }

    public function DocumentCategories():MorphMany
    {
        return $this->morphMany(DocumentCategory::class, 'relation')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->orderBy('name')
            ;
    }
    public function getPublicDocumentCategoriesAttribute(): Collection
    {
        return $this->DocumentCategories->where('is_show',true);
    }

    public function getDocuments():MorphMany
    {
        return $this->morphMany(Document::class, 'relation')
            ->whereNull('parent_id')
            ->orderBy('sort', 'desc')
            ->orderBy('name')
            ;
    }
}
