<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'id',

        'name',
        'alias',
        'route',
        'comment',

        'parent',

        'title',
        'keywords',
        'description',

        'sidebar',
        'view',
        'content',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $FormMessage = [
        'name'                      => 'Укажите заголовок',
        'route.required_without'    => 'Alias или Route должны быть заполнены',
        'alias.required_without'    => 'Alias или Route должны быть заполнены',
    ];

    public static function FormRules($id):array
    {
        return [
            'name'              => 'required',
            'alias'             => "nullable|unique:pages,alias,{$id},id,deleted_at,NULL|required_without:route",
            'comment'           => '',
            'route'             => 'required_without:alias',
            'parent'            => '',
            'title'             => '',
            'keywords'          => '',
            'description'       => '',
            'view'              => '',
            'sidebar'           => '',
            'content'           => '',
        ];
    }
    public function parentPage(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent', 'id');
    }

    public static function GetList():Collection
    {
        return self::orderBy('name')
            ->with([
                'parentPage',
            ])
            ->get();
    }

}
