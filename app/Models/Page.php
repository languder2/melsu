<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            'content'           => '',
        ];
    }
}
