<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    protected $table = 'page_contents';

    protected $fillable = [
        'title',
        'show_title',
        'content',
        'show',
        'order',
    ];

}
